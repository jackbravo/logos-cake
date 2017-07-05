<?php 
$this->layout = null;

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-type:application/vnd.ms-excel");
header("Content-Disposition: attachment;filename=Inventario".date("d/m/Y").".xls");
header("Content-Transfer-Encoding: binary");


?>

<table>
	<tr>
		<th>Codigo</th>
		<th>Familia</th>
		<th>No de Parte</th>
		<th>Bobina</th>
		<th>Largo</th>
		<th>Ancho</th>
		<th>Alto</th>
		<th>Piezas</th>
		<th>Fecha de Salida</th>
		<th>Documento</th>
		<th>Comentarios</th>
	</tr>
	<?php
foreach ($entries as $idx => $entry) {
    $family = $families[$entry['Part']['family_id']];
    $entry['Part']['Family'] = $family;
    $class = ($i++%2) ? 'altrow' : '';
    print_part_row($html, $class, $entry);
}
	?>
</table>

<?php function print_part_row($html, $class, $entry, $totalPieces=null) { ?>
    <tr class="<?php echo $class;?>">
        <td><?php echo $entry['Part']['family_id'] == 1 ? $entry['Part']['first_code'] : $entry['Entry']['id'];?></td>
        <td><?php echo $entry['Part']['Family']; ?></td>
        <td><?php echo $entry['Part']['number']; ?></td>
        <td><?php echo $entry['Identifier']['number']; ?></td>
        <td><?php echo $entry['Part']['long']; ?></td>
        <td><?php echo $entry['Part']['width']; ?></td>
        <td><?php echo $entry['Part']['height']; ?></td>
        <td><?php echo ($totalPieces === null) ? $entry['Entry']['pieces'] : $totalPieces; ?></td>
        <td><?php echo $entry['Entry']['created']; ?></td> 
        <td><?php echo $html->link($entry['Entry']['dispatch_id'], array('controller'=>'dispatches', 'action'=>'view', $entry['Entry']['dispatch_id'])); ?></td> 
        <td><?php echo trim($entry['Entry']['comments']); ?></td>
    </tr>
<?php } ?>
