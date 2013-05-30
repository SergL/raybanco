<table id="sortable-filter">
    <thead>
    <tr>
        <th>Название</th>
        <th width="36"></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($children as $child): ?>
    <tr id="Filter_id-<?php echo $child->id; ?>">
        <td><a href="<?php echo $this->createUrl('update', array('id'=>$child->id)); ?>"><?php echo $child->name; ?></a></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>