<?php

namespace App\Models\Requisitions;

use App\Helpers\DataHelper;
use App\Helpers\RequisitionNotifyHelper;
use App\Models\Clients\Job;
use App\Models\Commons\Group;
use App\Models\Commons\Plight;
use App\Models\Commons\SubGroup;
use App\Models\Users\Collaborator;
use App\Traits\CommonTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Date\Date;
use Zizaco\Entrust\EntrustFacade;

class Requisition extends Model
{
	use SoftDeletes;
	static public $_DOC_TYPE_          = ['Nota Fiscal', 'Cupom Fiscal', 'Recibo', 'Conta Telefone', 'Auto. Pagamento', 'Conta de Luz', 'Conta de Água'];
	static public $_PARCELAS_          = [
		'À VISTA',
		'30 DIAS','60 DIAS','90 DIAS',
		'SEM ENTRADA + 1', 'SEM ENTRADA + 2', 'SEM ENTRADA + 3', 'SEM ENTRADA + 4', 'SEM ENTRADA + 5', 'SEM ENTRADA + 6',
		'ENTRADA + 1', 'ENTRADA + 2', 'ENTRADA + 3', 'ENTRADA + 4', 'ENTRADA + 5', 'ENTRADA + 6'];
	const _STATUS_OPPENED_      = 1;
	const _STATUS_IN_QUOTATION_ = 2;
	const _STATUS_IN_APROVATION_= 3;
	const _STATUS_NOT_APPROVED_ = 4;
	const _STATUS_APPROVED_     = 5;
	const _STATUS_BUYED_        = 6;
	const _STATUS_DELIVERED_    = 7;

	use CommonTrait;
	public $timestamps = true;
	protected $fillable = [
		'author_id',
		'buyer_id',
		'approver_id',
		'job_id',

		'group_id',
		'subgroup_id',
		'plight_id',
		'status_id',

		'doc_type',
		'parcelas',
		'due',

		'request_at',
		'closed_at',
		'cotation_closed_at',
		'approved_at',
		'buy_at',
		'delivered_at',

		'document_number',
		'responsible',
		'main_descriptions',

		'reason',
		'address',
        'contact',
        'phone',
        'hour',
        'observations'
	];

	public function getReason()
	{
		return $this->attributes['reason'];
	}

	public function getDocumentNumber()
	{
		return ($this->attributes['document_number']==NULL || $this->attributes['document_number'] == "") ? "-" : $this->attributes['document_number'];
	}

	public function getResponsible()
	{
		return ($this->attributes['responsible']==NULL || $this->attributes['responsible'] == "") ? "-" : $this->attributes['responsible'];
	}

	public function getAddress()
	{
		return ($this->attributes['address']==NULL || $this->attributes['address'] == "") ? "-" : $this->attributes['address'];
	}

	public function getHour()
	{
		return ($this->attributes['hour']==NULL || $this->attributes['hour'] == "") ? "-" : $this->attributes['hour'];
	}

	public function getContact()
	{
		return ($this->attributes['contact']==NULL || $this->attributes['contact'] == "") ? "-" : $this->attributes['contact'];
	}
	public function getPhone()
	{
		return ($this->attributes['phone']==NULL || $this->attributes['phone'] == "") ? "-" : $this->attributes['phone'];
	}


	public function getDocTypeText()
	{
		return self::$_DOC_TYPE_[$this->attributes['doc_type']];
	}


	public function getParcelasText()
	{
		return self::$_PARCELAS_[$this->attributes['parcelas']];
	}


	public function getFormattedDue()
	{
		return DataHelper::getPrettyDate($this->attributes['due']);
	}

	public function setDueAttribute($value)
	{
		$this->attributes['due'] = DataHelper::setDate($value);
	}

	public function setBuyAtFormatted()
	{
		return DataHelper::getPrettyDateTime($this->attributes['buy_at']);
	}

	// ******************** FLUX FUNCTIONS ******************************
	static public function open($data)
	{
		return self::create([
			'job_id'            => $data['job_id'],
			'author_id'         => $data['author_id'],
			'group_id'          => $data['group_id'],
			'subgroup_id'       => $data['subgroup_id'],
			'main_descriptions' => $data['main_descriptions'],
			'request_at'        => Date::now(),
			'status_id'         => self::_STATUS_OPPENED_,
		]);
	}

	public function addBudgetProduct($data)
	{
		$data['requisition_id'] = $this->getAttribute('id');
		return RequisitionBudget::create($data);
	}

	public function addSupplier($data)
	{
		$data['requisition_id'] = $this->getAttribute('id');
		return RequisitionSupplier::create($data);
	}

	public function close()
	{
		$this->update([
			'status_id' => self::_STATUS_IN_QUOTATION_,
			'closed_at' => Date::now(),
		]);
		$notify = new RequisitionNotifyHelper($this);
		return $notify->closeRequisitionNotify();
	}
	public function reopen(array $data)
	{
		return $this->update([
			'status_id' => self::_STATUS_OPPENED_,
			'reason'    => $data['reason'],
			'closed_at' => NULL,
		]);
	}

	public function recotation()
	{
		return $this->update([
			'status_id' => self::_STATUS_IN_QUOTATION_,
			'closed_at' => Date::now(),
		]);
	}

	public function closeCotation($data)
	{
		$this->update([
			'status_id'             => self::_STATUS_IN_APROVATION_,
			'due'                   => $data['due'],
			'parcelas'              => $data['parcelas'],
			'doc_type'              => $data['doc_type'],
			'plight_id'             => $data['plight_id'],
			'cotation_closed_at'    => Date::now(),
		]);
		$notify = new RequisitionNotifyHelper($this);
		return $notify->closeCotationRequisitionNotify();
	}

	public function approve($data)
	{
		$this->update([
			'status_id'     => self::_STATUS_APPROVED_,
			'approved_at'   => Date::now(),
			'approver_id'   => $data['approver_id'],
		]);
		$notify = new RequisitionNotifyHelper($this);
		return $notify->approvedCotationRequisitionNotify();
	}


	public function unapprove($data)
	{
		 $this->update([
			'status_id'     => self::_STATUS_NOT_APPROVED_,
			'reason'        => $data['reason'],
		]);
		$notify = new RequisitionNotifyHelper($this);
		return $notify->notApprovedCotationRequisitionNotify();
	}

	public function buy($data)
	{
		return $this->update([
			'status_id'     => self::_STATUS_BUYED_,
			'buy_at'        => Date::now(),
			'buyer_id'      => $data['buyer_id'],
			'address'       => $data['address'],
			'contact'       => $data['contact'],
			'phone'         => $data['phone'],
			'hour'          => $data['hour'],
			'observations'  => $data['observations'],
		]);
	}

	public function delivery(array $data)
	{
		return $this->update([
			'status_id'         => self::_STATUS_DELIVERED_,
			'document_number'   => $data['document_number'],
			'responsible'       => $data['responsible'],
			'delivered_at'      => Date::now(),
		]);
	}

	// ******************** STATUS ******************************


	public function getTabActive($tab)
	{
		switch($this->attributes['status_id']){
			case self::_STATUS_OPPENED_:
			case self::_STATUS_IN_QUOTATION_:
				return ($tab == 'tab_requisition_products');
			default:
				return ($tab == 'tab_requisition');
		}
	}

	public function getBreadcrumb()
	{
		$breadcrumb = array();
		for($i = 1; $i <= 6; $i++){
			if($this->attributes['status_id'] < $i){
				$breadcrumb[] = ['class'=>'font-italic col-blue-grey', 'text' => self::getStatusTextById($i) . $this->getTimeAction($i)];
			} else {
				$breadcrumb[] = ['class'=>'font-bold col-teal', 'text' => self::getStatusTextById($i) . $this->getTimeAction($i)];
			}
		}
		return $breadcrumb;
	}

	public function getTimeAction($i = NULL)
	{
		$i = ($i == NULL) ? $this->attributes['status_id'] : $i;
		switch($i){
			case self::_STATUS_OPPENED_:
				return ' (' . DataHelper::getPrettyDateTime($this->attributes['request_at']) . ')';
			case self::_STATUS_IN_QUOTATION_:
				return ($this->attributes['closed_at'] != NULL) ? ' (' . DataHelper::getPrettyDateTime($this->attributes['closed_at']) . ')' : '';
			case self::_STATUS_IN_APROVATION_:
				return ($this->attributes['cotation_closed_at'] != NULL) ? ' (' . DataHelper::getPrettyDateTime($this->attributes['cotation_closed_at']) . ')' : '';
//			case self::_STATUS_NOT_APPROVED_:
//				return ' (Não aprovado)';
			case self::_STATUS_APPROVED_:
				return ($this->attributes['approved_at'] != NULL) ? ' (' . DataHelper::getPrettyDateTime($this->attributes['approved_at']) . ')' : '';
			case self::_STATUS_BUYED_:
				return ($this->attributes['buy_at'] != NULL) ? ' (' . DataHelper::getPrettyDateTime($this->attributes['buy_at']) . ')' : '';
			case self::_STATUS_DELIVERED_:
				return ($this->attributes['delivered_at'] != NULL) ? ' (' . DataHelper::getPrettyDateTime($this->attributes['delivered_at']) . ')' : '';
		}
	}

	public function getActionRoute()
	{
		switch($this->attributes['status_id']){
			case self::_STATUS_IN_QUOTATION_:
				return 'close_cotation';
			case self::_STATUS_NOT_APPROVED_:
			case self::_STATUS_IN_APROVATION_:
				return 'approve';
			case self::_STATUS_APPROVED_:
				return 'buy';
			case self::_STATUS_BUYED_:
				return 'delivery';
		}
	}

	public function canShowBuyInfo()
	{
		return (($this->attributes['status_id'] == self::_STATUS_BUYED_) || ($this->attributes['status_id'] == self::_STATUS_DELIVERED_));
	}

	public function canShowReasonInfo()
	{
		return ($this->attributes['status_id'] == self::_STATUS_NOT_APPROVED_);
	}

	public function canShowApproveInfo()
	{
		return (($this->attributes['status_id'] == self::_STATUS_APPROVED_)
		        || ($this->attributes['status_id'] == self::_STATUS_BUYED_)
		        || ($this->attributes['status_id'] == self::_STATUS_DELIVERED_));
	}

	public function canShowPrintBudgetBtn()
	{
		return (($this->attributes['status_id'] == self::_STATUS_IN_QUOTATION_) && (EntrustFacade::hasRole(['buyer'])));
	}

	public function canShowPrintBuyedBtn()
	{
		return (($this->attributes['status_id'] == self::_STATUS_BUYED_));
	}

	public function canShowAddBudgetBtn()
	{
		return (($this->attributes['status_id'] == self::_STATUS_OPPENED_) && (EntrustFacade::hasRole(['coordenator','manager','financial'])));
	}

	public function canShowAddProductToBudgetBtn()
	{
		return (($this->attributes['status_id'] == self::_STATUS_IN_QUOTATION_) && (EntrustFacade::hasRole(['buyer'])));
	}

	public function canShowEditProductToBudgetBtn()
	{
		return (($this->attributes['status_id'] == self::_STATUS_IN_QUOTATION_) && (EntrustFacade::hasRole(['buyer'])));
	}

	public function canShowRemBudgetBtn()
	{
		return (($this->attributes['status_id'] == self::_STATUS_OPPENED_) && (EntrustFacade::hasRole(['coordenator','manager','financial'])));
	}

	public function canShowRemProductBtn()
	{
		return (($this->attributes['status_id'] != self::_STATUS_OPPENED_)
		        && ($this->attributes['status_id'] != self::_STATUS_DELIVERED_)
		        && ($this->attributes['status_id'] != self::_STATUS_APPROVED_));
	}

	public function canShowCloseCotationBtn()
	{
		return (($this->attributes['status_id'] == self::_STATUS_IN_QUOTATION_) && (EntrustFacade::hasRole(['buyer'])));
	}

	public function canShowApproveBtn()
	{
		return (($this->attributes['status_id'] == self::_STATUS_IN_APROVATION_) && (EntrustFacade::hasRole(['coordenator','manager','financial'])));
	}

	public function canShowRecotationBtn()
	{
		return (($this->attributes['status_id'] == self::_STATUS_NOT_APPROVED_) && (EntrustFacade::hasRole(['buyer'])));
	}

	public function canShowUnApproveBtn()
	{
		return (($this->attributes['status_id'] == self::_STATUS_IN_APROVATION_) && (EntrustFacade::hasRole(['coordenator','manager','financial'])));
	}

	public function canShowUnApproveForm()
	{
		return (($this->attributes['status_id'] == self::_STATUS_IN_APROVATION_) && (EntrustFacade::hasRole(['coordenator','manager','financial'])));
	}

	public function canShowBuyBtn()
	{
		return (($this->attributes['status_id'] == self::_STATUS_APPROVED_) && (EntrustFacade::hasRole(['buyer'])));
	}

	public function canShowDeliveryBtn()
	{
		return (($this->attributes['status_id'] == self::_STATUS_BUYED_) && (EntrustFacade::hasRole(['buyer','coordenator','manager','financial'])));
	}

	public function canShowCloseBtn()
	{
		return (($this->attributes['status_id'] == self::_STATUS_OPPENED_) && (EntrustFacade::hasRole(['coordenator','manager','financial'])));
	}
	public function canShowReopenBtn()
	{
		return (($this->attributes['status_id'] == self::_STATUS_IN_QUOTATION_) && (EntrustFacade::hasRole(['coordenator','manager','financial'])));
	}

	public function canShowDeleteRequisition()
	{
		return EntrustFacade::hasRole(['manager']);
	}

	public function getActionBtnColor()
	{
		switch($this->attributes['status_id']){
			case self::_STATUS_IN_QUOTATION_:
			case self::_STATUS_IN_APROVATION_:
				return 'light-blue';
			case self::_STATUS_APPROVED_:
				return 'deep-purple';
			case self::_STATUS_BUYED_:
				return 'light-green';
		}
	}

	public function getActionBtnText()
	{
		switch($this->attributes['status_id']){
			case self::_STATUS_IN_QUOTATION_:
				return 'Fechar Cotação';
			case self::_STATUS_IN_APROVATION_:
				return 'Aprovar';
			case self::_STATUS_APPROVED_:
				return 'Comprar';
			case self::_STATUS_BUYED_:
				return 'Entregar';
		}
	}

	public function getActionBtnIcon()
	{
		switch($this->attributes['status_id']){
			case self::_STATUS_IN_QUOTATION_:
			case self::_STATUS_IN_APROVATION_:
				return 'check';
			case self::_STATUS_APPROVED_:
				return 'attach_money';
			case self::_STATUS_BUYED_:
				return 'directions_bus';
		}
	}

	public function getStatusColor()
	{
		switch($this->attributes['status_id']){
			case self::_STATUS_OPPENED_:
				return 'grey';
			case self::_STATUS_IN_QUOTATION_:
				return 'orange';
			case self::_STATUS_IN_APROVATION_:
				return 'amber';
			case self::_STATUS_NOT_APPROVED_:
				return 'red';
			case self::_STATUS_APPROVED_:
				return 'light-blue';
			case self::_STATUS_BUYED_:
				return 'deep-purple';
			case self::_STATUS_DELIVERED_:
				return 'light-green';
		}
	}

	static public function getStatusTextById($id)
	{
		switch($id){
			case self::_STATUS_OPPENED_:
				return 'Aberta';
			case self::_STATUS_IN_QUOTATION_:
				return 'Em Cotação';
			case self::_STATUS_IN_APROVATION_:
				return 'Em Aprovação';
			case self::_STATUS_NOT_APPROVED_:
				return 'Não aprovada';
			case self::_STATUS_APPROVED_:
				return 'Aprovada';
			case self::_STATUS_BUYED_:
				return 'Comprada';
			case self::_STATUS_DELIVERED_:
				return 'Entregue';
		}
	}

	public function getStatusText()
	{
		return self::getStatusTextById($this->attributes['status_id']);
	}

	// ******************** FUNCTIONS ******************************

	public function getTotalMoney()
	{
		return DataHelper::getFloat2Currency($this->getTotal());
	}

	public function getTotal()
	{
		return $this->requisition_budgets->sum(function ($p) {
			return $p->getTotal();
		});
	}

	public function getShortPlightName()
	{
		return ($this->plight_id != NULL)? $this->plight->getShortName() : "-";
	}

	public function getShortName()
	{
		return "#: " . $this->getAttribute('id');
	}

	public function getUnitFullAddress()
	{
		return $this->job->getUnitFullAddress();
	}

	public function getClientId()
	{
		return $this->job->getClientId();
	}

	public function getClientIe()
	{
		return $this->job->getClientIe();
	}

	public function getClientShortDocument()
	{
		return $this->job->getClientShortDocument();
	}

	public function getClientShortName()
	{
		return $this->job->getClientShortName();
	}

	public function getJobShortName()
	{
		return $this->job->getShortName();
	}

	public function getUnitShortName()
	{
		return $this->job->unit->getShortName();
	}

	public function getAuthorShortName()
	{
		return $this->author->getShortName();
	}
	public function getUnitJobShortName()
	{
		return $this->getUnitShortName() . ' / ' . $this->getJobShortName();
	}


	public function requisitionBudgetsFormatted()
	{
		return $this->requisition_budgets->map(function($s){
			if($s->requisition_buy != NULL){
				$r = $s->requisition_buy;
				$s->buy_id              = $r->id;
				$s->buy_brand           = $r->getBrandName();
				$s->buy_supplier        = $r->supplier;
				$s->buy_supplier_name   = $r->supplier->getCompanyName();
				$s->buy_value           = $r->value;
				$s->buy_value_money     = $r->getValueMoney();
				$s->buy_quantity        = $r->getQuantityFormatted();
				$s->buy_total           = $r->getTotalValue();
				$s->buy_total_money     = $r->getTotalValueMoney();
				$s->buy                 = true;
			} else {
				$s->buy_id              = '-';
				$s->buy_brand           = '-';
				$s->buy_supplier        = '-';
				$s->buy_supplier_name   = '-';
				$s->buy_value           = '-';
				$s->buy_value_money     = '-';
				$s->buy_quantity        = '-';
				$s->buy_total           = '-';
				$s->buy_total_money     = '-';
				$s->buy                 = false;
			}
			return $s;
		});
	}

	public function requisitionBudgets()
	{
		return $this->requisition_budgets;
	}
	// ******************** RELASHIONSHIP ******************************

	public function job()
	{
		return $this->belongsTo(Job::class, 'job_id');
	}
	public function author()
	{
		return $this->belongsTo(Collaborator::class, 'author_id');
	}
	public function buyer()
	{
		return $this->belongsTo(Collaborator::class, 'buyer_id');
	}
	public function approver()
	{
		return $this->belongsTo(Collaborator::class, 'approver_id');
	}
	public function group()
	{
		return $this->belongsTo(Group::class, 'group_id');
	}
	public function subgroup()
	{
		return $this->belongsTo(SubGroup::class, 'subgroup_id');
	}
	public function plight()
	{
		return $this->belongsTo(Plight::class, 'plight_id');
	}
	public function requisition_budgets()
	{
		return $this->hasMany(RequisitionBudget::class, 'requisition_id');
	}
	public function requisition_budgets_by_supplier()
	{
		return $this->hasMany(RequisitionBudget::class, 'requisition_id');
	}



}
