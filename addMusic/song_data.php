<?php
# to prevent access from URL
if(!session_start()) {
    header("Location: ../error.php");
    exit;
}
if(!$fromRequired) {
    header("Location: ../index.php");
    exit;
}
?>

<div class='centered'>
    <label for="genre" class='selectorText'>Genre:</label>
    <select name="genre" id="genre" class="selectmenu">
        <option value="Rock" selected>Rock</option>
        <option value="Pop" >Pop</option>
        <option value="Jazz">Jazz</option>
        <option value="Classical">Classical</option>
        <option value="LoFi/Vaporwave">LoFi/Vaporwave</option>
        <option value="Blues">Blues</option>
        <option value="Rap">Rap</option>
        <option value="R&B">R&B</option>
        <option value="Funk">Funk</option>
        <option value="Reggae">Reggae</option>
        <option value="Metal">Metal</option>
        <option value="Country">Country</option>
        <option value="Film">Film</option>
        <option value="Gaming">Gaming</option>
        <option value="Other">Other</option>
    </select>
</div>
<div class='centered'>
    <label for="decade" class='selectorText'>Decade(s):</label>
    <select name="decade" id="decade" class="selectmenu">
        <option value="2010s" selected>2010s</option>
        <option value="2000s" >2000s</option>
        <option value="1990s">1990s</option>
        <option value="1980s">1980s</option>
        <option value="1970s">1970s</option>
        <option value="1960s">1960s</option>
        <option value="1950s">1950s</option>
        <option value="1900-1950">1900-1950</option>
        <option value="1800-1900">1800-1900</option>
        <option value="1700-1800">1700-1800</option>
        <option value="1600-1700">1600-1700</option>
        <option value="Before 1600">Before 1600</option>
    </select>
</div>
<div class='centered'>
    <label for="category" class='selectorText'>Category:</label>
    <select name="category" id="category" class="selectmenu">
        <option value="Popular" selected>Popular</option>
        <option value="Fine Art" >Fine Art</option>
        <option value="Folk">Folk</option>
        <option value="Meme">Meme</option>
        <option value="Media">Media</option>
        <option value="Other">Other</option>
    </select>
</div>