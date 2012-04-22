<script type="text/javascript" language="javascript">
$(function() {
    $( "#calendar" ).datepicker();
});
</script>
<div id="menu">
    <h1><?php echo $data['menuType']['name'] ?></h1>
    <div class="description"><?php echo $data['menuType']['description'] ?></div>
    <div id="calendar"></div>
<?php foreach ($data['sections'] as $section): ?>
    <div class="section">
        <h2><?php echo $section['name'] ?></h2>
        <ul class="products">
            
        </ul>
    </div>
<?php endforeach ?>
</div>
<?php
/* End of file menuOfTheDay.php */
/* Location: ./application/views/menu/types/menuOfTheDay.php */