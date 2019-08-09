<script>
    $(document).ready(function(){
        $(".action").on('click', function(){
            let id = $(this).attr('data-id');
            //console.log(id);
            $.ajax({
                url: "/?c=basket&a=addBasket",
                type: "POST",
                dataType : "json",
                data:{
                    id: id
                },
                error: function() {alert('error');},
                success: function(answer){
                    {
                        $("#count").html(answer.count);
                    }
                }

            })
        })

    });
</script>