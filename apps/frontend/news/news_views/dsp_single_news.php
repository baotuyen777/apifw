 <?php 
   // $data=$this->data;
  //  $item=$data[0];
    $user=$this->user;
    
    
 ?>

<div class="content">
    <h1>Thêm tin tức</h1>
    <div >Thêm với tư cách là: <b class="blue"><?php echo $user[0]['emp_name'];?></b><a href="/mvc3/user/logout"> Không phải tôi</a></div>
    <form action="/mvc3/news/do_update_news" method="post">
        <input type="hidden" name="hdn_user_id" value="<?php echo $user[0]['emp_id']?>">
        <input type="hidden" name="hdn_news_id" value="<?php if(($this->id)!==""){echo $this->id;}?>">
        <span>Title</span><input type="text" name="txtTitle" class="input-xxlarge"><br>
        <span>Content</span><textarea name="txtContent" class="input-xxlarge"></textarea><br>
        
        <input type="submit">
    </form>
</div>
