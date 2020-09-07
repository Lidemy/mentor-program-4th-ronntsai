<?php 
    $sql = "SELECT category_id, category_name FROM Ronn_blog_category ORDER BY category_id asc";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute();
    if(!$result) {
        die('Error:' . $conn->error);
    }
    $result = $stmt->get_result();
?>

<div class="combo-box__category">文章分類：
    <select name="category">
        <?php 
            while($row = $result->fetch_assoc()) {
        ?>
            <option <?php if($_GET['category_id'] == $row['category_id']) { echo 'selected = "selected" '; } ?> value="<?php echo escape($row['category_id'])?>"><?php echo escape($row['category_name'])?></option>
        <?php }?>
    </select>
</div>