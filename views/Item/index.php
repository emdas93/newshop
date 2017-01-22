<div class = "subTitle">
    <h3><?php echo $subTitle ?></h3>
</div>
<?php foreach($list as $row){ ?>
    <div class = "itemBox">
        <div class = "itemimg">
            <a href="<?php echo URL."item/view/".$row->item_no; ?>"><img src="<?php echo URL.$row->item_titleImg ?>" alt="">
        </div>
        <a href="<?php echo URL."item/view/".$row->item_no; ?>"><p><?php echo $row->item_title; ?></p></a>
        <p><?php echo $row->item_price; ?>원</p>
    </div>
<?php } ?>
<div class="itemPage">
    <?php if($pageNo==1){}else{ ?>
    <a href="<?php echo URL."item/index/".$pagename."/".($pageNum-1); ?>">이전</a>
    <?php } ?>
    <?php for($i=$startPage;$i<$endPage;++$i){ ?>
        <a href="<?php echo URL."item/index/".$pagename."/".$i; ?>"><?php echo $i?></a>
    <?php } ?>
    <?php if($pageNo==$total_content || $list_count == 0){}else{ ?>
    <a href="<?php echo URL."item/index/".$pagename."/".($pageNum+1); ?>">다음</a>
    <?php } ?>
</div>
<div class="itemMenu">
    <a href="<?php echo URL."item/writeView"; ?>">상품등록</a>
</div>
