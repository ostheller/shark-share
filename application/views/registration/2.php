<?php echo validation_errors(); ?>
<?php echo validation_errors(); ?>

<?php echo form_open('accept'); 

$data = array(
    'responsibility'        => 'newsletter',
    'acknowledgement'          => 'newsletter',
    'shipping'       => 'accept',
    'checked'     => TRUE,
    'style'       => 'margin:10px',
    );

echo form_checkbox($data); ?>

<input type="hidden" name="page" value="2" />

<div><input type="submit" value="Submit" /></div>

</form>