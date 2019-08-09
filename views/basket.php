
<? foreach($products as $product): ?>
<div id="<?= $product['id_basket']?>">
    <a href="/?c=product&a=card&id=<?=$product['id']?>">
        <h2><?=$product['name']?></h2>
    </a>
    <p><?=$product['description']?></p>
    <p>Стоимость: <?=$product['price']?></p>
    <button data-id="<?= $product['id_basket']?>" class="delete">Удалить</button>
</div>
    
<? endforeach; ?>
<br>
<form action="?page=catalog"> 
<input type="hidden" name="c" value="orders">
<input type="hidden" name="a" value="send">
    <input type='text' name='name' placeholder='имя'> <br>
	<input type='text' name='email' placeholder='почта'> <br>
	<input type='text' name='tel' placeholder='телефон'><br>
    <input type='submit' name='order' value="Отправить заказ">
	
</form>

<script>
    $(document).ready(function(){
        $(".delete").on('click', function(){
            let id = $(this).attr('data-id');
            //console.log(id);
            $.ajax({
                url: "/?c=basket&a=delBasket",
                type: "POST",
                dataType : "json",
                data:{
                    id: id
                },
                error: function() {alert('error');},
                success: function(answer){
                    {   
                        $('#' + id).remove();
                        $("#count").html(answer.count);
                    }
                }

            })
        });

    });
</script>


