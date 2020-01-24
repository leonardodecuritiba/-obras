<script>
    $(document).ready(function(){
        // $($_INPUT_CLIENT_).selectpicker();
        // $($_INPUT_UNIT_).selectpicker();
        // $($_INPUT_JOB_).selectpicker();

        //CHANGING UNIT - FILL JOBS
        $($_INPUT_CLIENT_).change(function(){
            var $this = $_INPUT_CLIENT_;
            var $this_child = $_INPUT_JOB_;
            var text_child = 'Escolha a Unidade / Obra';
            var _url = '{{route('ajax.get.client-jobs')}}';

            $($this_child).empty();
            $($this_child).append("<option value=''>" + text_child + "</option>");
            // $($this_child).val('').change().selectpicker('render');

            if($($this).val() == ""){
                return false;
            }

            $.ajax({
                url: _url,
                data: {id : $($this).val()},
                type: 'GET',
//                    dataType: "json",
                beforeSend: function (xhr, textStatus) {
                    loadingCard('show',$this);
                },
                error: function (xhr, textStatus) {
                    console.log('xhr-error: ' + xhr.responseText);
                    console.log('textStatus-error: ' + textStatus);
                    loadingCard('hide',$this);
                },
                success: function (json) {
                    console.log(json);
                    $(json).each(function(i,v){
                        $($this_child).append('<option value="' + v.id + '">' + v.text + '</option>')
                    });
                    // $($this_child).selectpicker("refresh");
                    $_LOADING_.waitMe('hide');
                }
            });
        });

    });
</script>