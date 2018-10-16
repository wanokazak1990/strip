<?php
namespace app\core;
class Html{
	public static function printArray($array = array()) {
		echo "<pre>";
		print_r($array);
		echo "</pre>";
	}
	
	public static function getImage($name){
		return $name;
	}

	public static function addText($name,$value="",$label="",$class="")
	{
	?>
		<div class="block-text">
			<?php if($label) : ?>
				<label><?=$label;?></label>
			<?php endif;?>
			<input 
				type="text" 
				name="<?=$name;?>" 
				value="<?=$value;?>" 
				id="<?=$name;?>" 
				class="<?=$class;?>"
			>
		</div>
	<?php
	}

	public static function addTextArea($name,$value="",$label="",$class="")
	{
	?>
		<div class="block-text">
			<?php if($label) : ?>
				<label><?=$label;?></label>
			<?php endif;?>
			<textarea name="<?=$name;?>" id="<?=$name;?>" class="<?=$class;?>">
				<?=$value;?>
			</textarea> 
		</div>
	<?php
	}

	public static function addOneCheck($name,$value,$label="",$class="")
	{
	?>
		<div class="block-text">
			<?php if($label) : ?>
				<label><?=$label;?></label>
			<?php endif;?>
			<input 
				type="checkbox"
				name="<?=$name;?>"
				id="<?=$name;?>"
				class="<?=$class;?>"
				<?=($value)?"checked":"";?> 
				value="1"
			>
		</div>
	<?php
	}

	public static function addSelect($name,$value,$input,$label="",$class="")
	{
	?>
		<div class="block-text">
			<?php if($label) : ?>
				<label><?=$label;?></label>
			<?php endif;?>
			<select class="<?=$class;?>" name="<?=$name;?>" id="<?=$name;?>">
				<option selected="" disabled="" value="0">Укажите раздел</option>
				<?php foreach ($input as $id => $name) :?>
					<option value="<?=$id;?>" <?=($id==$value)?"selected":"";?>><?=$name;?></option>
				<?php endforeach;?>
			</select>
		</div>
	<?php
	}

	public function addFile($name,$value,$label="",$class="")
	{
	?>
		<div class="fileload">
			<?php if(!empty($label)) : ?>
				<label><?=$label;?></label>
			<?php endif;?>
			<?php if($value) : ?>
				<img src="<?=$value;?>">
			<?php endif;?>
			<input type="file" name="<?=$name;?>" class="<?=$class;?>" id="<?=$name;?>">
		</div>
	<?php
	}
}
?>