<!-- Jquery Core Js -->
{{--{{Html::script('bower_components/adminbsb-materialdesign/plugins/jquery/jquery.min.js')}}--}}
{{Html::script('bower_components/jquery/dist/jquery.min.js')}}

<!-- Bootstrap Core Js -->
{{--{{Html::script('bower_components/adminbsb-materialdesign/plugins/bootstrap/js/bootstrap.js')}}--}}
{{Html::script('bower_components/bootstrap/dist/js/bootstrap.min.js')}}

{{--<!-- Slimscroll Plugin Js -->--}}
{{--{{Html::script('bower_components/adminbsb-materialdesign/plugins/jquery-slimscroll/jquery.slimscroll.js')}}--}}
{{Html::script('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}

<!-- Waves Effect Plugin Js -->
{{Html::script('bower_components/adminbsb-materialdesign/plugins/node-waves/waves.js')}}

<!-- Custom Js -->
{{--{{Html::script('bower_components/adminbsb-materialdesign/js/admin.js')}}--}}
{{Html::script('js/adminbsb-admin.js')}}

{{--<!-- Demo Js -->--}}
{{--{{Html::script('bower_components/adminbsb-materialdesign/js/demo.js')}}--}}
{{Html::script('js/plugins/waitMe.js')}}

<script>
    var $_LOADING_ = {};
    var $_TABLE_ = {};
    var $_DATATABLE_OPTIONS_ = {
        "dom": 'Bfrtip',
        "responsive": true,
        "buttons": [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
        },
        "pageLength": 10,
        "order": [2, "asc"]
    };

    function loadingCard(type,$this){
        if(type == 'show'){
            $_LOADING_ = $($this).parents('.card').waitMe({
                effect: 'pulse',
                text: 'Aguarde...',
                bg: 'rgba(255,255,255,0.90)',
                color: '#555'
            });
        } else {
            $_LOADING_.waitMe('hide');
        }
    }
    $(function () {
        //Tooltip
        $('[data-toggle="tooltip"]').tooltip({
            container: 'body'
        });

        //Popover
//        $('[data-toggle="popover"]').popover();
    })
</script>

@yield('script_content')