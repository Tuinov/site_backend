<h2><?=$product->name?></h2>
<p><?=$product->description?></p>
<p>Стоимость: <?=$product->price?></p>

<button data-id="<?=$product->id?>" class="action">Купить</button><br>

<?php
include 'script.js';
