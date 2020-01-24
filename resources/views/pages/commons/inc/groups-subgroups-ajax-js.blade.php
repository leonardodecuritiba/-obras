<script>
    $(document).ready(function(){
        // $($_INPUT_GROUP_).selectpicker();
        // $($_INPUT_SUBGROUP_).selectpicker();

        //CHANGING UNIT - FILL JOBS
        $($_INPUT_GROUP_).change(function(){
            var $this = $_INPUT_GROUP_;
            var $this_child = $_INPUT_SUBGROUP_;
            var text_child = 'Escolha o Subgrupo';
            var _url = '{{route('ajax.get.groups-subgroups')}}';

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
    })
</script>