<?php

namespace App\Notifications;

use App\Models\Requisitions\Requisition;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class closeCotationRequisitionNotify extends Notification implements ShouldQueue
{
    use Queueable;

	public $requisition;
	public $username;
	/**
	 * Create a new notification instance.
	 *
	 * @param \App\Models\Requisitions\Requisition $requisition
	 * @param $username
	 * @return void
	 */
	public function __construct(Requisition $requisition, $username)
	{
		$this->requisition = $requisition;
		$this->username = $username;
		//
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function via($notifiable)
	{
		return ['mail'];
		return ['mail', 'database'];
	}

	/**
	 * Get the mail representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable)
	{
		$id = $this->requisition->id;
		$url = route('requisitions.show', $id);

		return (new MailMessage)
//			->cc(['silva.zanin@gmail.com', 'glauco@tracoconstrucao.com.br'])
			->success()
			->subject('A cotação da requisição #' . $id . ' foi fechada')
			->greeting('Olá ' .$this->username .'!')
			->line('A cotação #' . $id . ' foi fechada!')
			->action('Abrir Requisição', $url);
	}

	/**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
