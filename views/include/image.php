<?php 

	$artista = str_replace(' ','_',$viewData['art_nome']);

	if($lay_Width == false){
		$lay_Widht = 'width: 21%';	
	}elseif($lay_Width == true) {
		$lay_Widht = 'max-width: 100%';
	}
	elseif($lay_Width == 'certificado') {
		$lay_Widht = 'width=366 height=468';
	}elseif($lay_Widht == 'recibo'){
		$lay_Widht = 'width: 140.70px; height: 208.14px; margin-left: 0.00px; margin-top: 0.00px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px)';
	}elseif($lay_Widht == 'mobile'){
		$lay_Widht = 'max-width=40%;';
	}

	$img = $this->inventario->getImagesByProductId($viewData['id_inventario']);
	

?>

<?php if(file_exists('assets/images/anuncios/'.$artista.'/'.$viewData['id_inventario'].'.jpg')): ?>

	<img src="<?php echo BASE_URL?>assets/images/anuncios/<?php echo $artista ?>/<?php echo $viewData['id_inventario'] ?>.jpg" style="<?php echo $lay_Widht ?>;" /> 

<?php elseif(isset($img['url']) && $img['url'] != ''): ?>
	
	<img src="<?php echo BASE_URL?>assets/images/anuncios/<?php echo $artista ?>/<?php echo $img['url'] ?>" class="img-table" style="<?php echo $lay_Widht ?>;"/> 
		
<?php else: ?>

	<img src="https://www.buritama.sp.leg.br/imagens/parlamentares-2013-2016/sem-foto.jpg/image" class="img-table" style="<?php echo $lay_Widht ?>;"/>

<?php endif; ?>

