<div class="parts index">

<h2>Historial</h2>

<ul class="filters">
    <li><a href="/parts/history/">Todo</a></li>
    <?php
        foreach($families as $id => $name)
        {
            echo "<li><a href='/parts/history/index/family:$id'>$name</a></li>";
        }
    ?>
    <li><a href="/parts/">Inventario</a></li>
</ul>

<table cellpadding="0" cellspacing="0" class="">
<thead>
<tr>
    <?php $paginator->options(array('url' => $this->passedArgs)); ?>
    <?php if (!isset($family_id)): ?>
        <th>Codigo</th>
    <?php elseif ($family_id == '1'): ?>
        <th><?php echo $paginator->sort('Codigo', 'Part.first_code'); ?></th>
    <?php else: ?>
        <th><?php echo $paginator->sort('Codigo', 'Entry.id'); ?></th>
    <?php endif; ?>
	<th><?php echo $paginator->sort('Fam', 'Part.family_id'); ?></th>
	<th><?php echo $paginator->sort('No Parte', 'Part.number'); ?></th>
    <th><?php echo $paginator->sort('Bobinas', 'Identifier.number'); ?></th>
    <th>Largo</th>
    <th>Ancho</th>
    <th>Alto</th>
    <th>Piezas</th>
	<th><?php echo $paginator->sort('Salida', 'created'); ?></th>
	<th><?php echo $paginator->sort('Doc', 'dispatch_id'); ?></th>
	<th>Comentarios</th>			    
</tr>
</thead>
<tbody>
<?php
$i = 0;
foreach ($entries as $idx => $entry) {
    $family = $families[$entry['Part']['family_id']];
    $entry['Part']['Family'] = $family;
    $class = ($i++%2) ? 'altrow' : '';
    print_part_row($html, $class, $entry);
}
?>
</tbody>
</table>
</div>

<div class="pagination">
<!-- Shows the next and previous links -->
<?php
    echo '<div>' . $paginator->prev('Anterior', null, null, array('class' => 'disabled')) . ' </div>';
    echo '<div>' . $paginator->numbers() . ' </div>';
    echo '<div>' . $paginator->next('Siguiente', null, null, array('class' => 'disabled')) . '</div>';
?> 
<!-- prints X of Y, where X is current page and Y is number of pages -->
<br>
<?php echo $paginator->counter(); ?>
</div>

<div class="actions">

	<ul>
		<li>
            <?php 
            // NOTA!!! no estamos desplegando este link porque genera un archivo muy grande
            if (isset($family_id))
            {
                //echo $html->link(__('Exportar a .XLS', true), array('action' => 'exportHistory',$family_id)); 
            }
            else
            {
                //echo $html->link(__('Exportar a .XLS', true), array('action' => 'exportHistory'));
            }
            ?>
        </li>
	</ul>
</div>

<!-- // use same function as parts/index -->
<?php function print_part_row($html, $class, $entry, $totalPieces=null) { ?>
    <tr class="<?php echo $class;?>">
        <td><?php echo $entry['Part']['family_id'] == 1 ? $entry['Part']['first_code'] : $entry['Entry']['id'];?></td>
        <td><?php echo $entry['Part']['Family']; ?></td>
        <td class="part-num"><?php echo $entry['Part']['number']; ?></td>
        <td class="bobina"><?php echo $entry['Identifier']['number']; ?></td>
        <td><?php echo $entry['Part']['long']; ?></td>
        <td><?php echo $entry['Part']['width']; ?></td>
        <td><?php echo $entry['Part']['height']; ?></td>
        <td><?php echo ($totalPieces === null) ? $entry['Entry']['pieces'] : $totalPieces; ?></td>
        <td><?php echo $entry['Entry']['created']; ?></td> 
        <td><?php echo $html->link($entry['Entry']['dispatch_id'], array('controller'=>'dispatches', 'action'=>'view', $entry['Entry']['dispatch_id'])); ?></td> 
        <td class="comment-box" style="width: auto;">
            <?php echo str_replace("\n", "<br>", $entry['Entry']['comments']); ?>
        </td>     		    		   		
    </tr>
<?php } ?>
