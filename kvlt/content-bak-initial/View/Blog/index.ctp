<?if(empty($_GET['ajax'])) { ?>

    <div style="width: 800px; margin: 0 auto;">
        <div style="float: left; width: 400px; padding-right: 25px;">

            <h3>Posts</h3>
            <?if(!empty($blog_category)) { ?>
                In "<i><?=$blog_category;?></i>"
            <? } else if(!empty($_GET['search'])) { ?>
                Filtered by "<i><?=$_GET['search'];?></i>"
            <? } ?>
            <hr />

            <div id="results">
                <?if(!empty($results)) { ?>
                    <?for($i=0; $i<count($results); $i++) { ?>
                        <img src="https://2df79e695acdb7549107-880e37d91bcd6aa1176c75eb5abedb5a.ssl.cf5.rackcdn.com/blog/<?=$results[$i]['AppBlogPost']['id'];?>_main.jpg" onError="this.src='/img/blog/missing.png';" style="width: 100%;" />
                        <br />
                        ID:<br />
                        <?=$results[$i]['AppBlogPost']['id'];?><br /><br />
                        TITLE: <br />
                        <?=$results[$i]['AppBlogPost']['title'];?><br /><br />
                        BODY:<br />
                        <?=$results[$i]['AppBlogPost']['body'];?><br /><br />
                        CATEGORIES:<br />
                        <?=$results[$i][0]['categories'];?><br /><br />
                        PUBLISH DATE:<br />
                        <?=$results[$i]['AppBlogPost']['post_date'];?><br />
                        <a href="<?=trim($results[$i]['AppBlogPost']['permalink']);?>-<?=$results[$i]['AppBlogPost']['id'];?>">LINK</a>
                        <hr />
                    <? } ?>
                <? } else { ?>
                    &#187; No posts found
                <? } ?>
            </div>

            <img class="blog_loading" src="/img/blog/loading_small.gif" alt="Loading" style="display: none;" />

            <?if(count($results)==2) { ?>
                <a href="#" class="blog_get_results btn btn-default">Load More</a>
            <? } ?>

        </div>
        <div style="float: left; width: 300px;">
            <h3>Categories</h3>
            <hr />

            <?if(!empty($blog_categories)) { ?>
                <ul>
                    <?foreach($blog_categories as $key=>$value) { ?>
                        <li><a href="/blog/<?=strtolower(urlencode(str_replace(' ','-',$value)));?>"><?=$value;?></a></li>
                    <? } ?>
                </ul>
            <? } ?>

            <br /><br />

            <h3>Search</h3>
            <form id="blog_form_search" action="" method="post">
                <input type="text" name="search" value="" placeholder="Search Blog" />
                <input type="submit" value="Search" />
            </form>
        </div>
        <div style="clear:both;"></div>
    </div>

    <script>
    var page_blog_results_category = "<?=(!empty($blog_category)?$blog_category:'');?>";
    var page_blog_results_search = "<?=(!empty($_GET['search'])?$_GET['search']:'');?>";
    </script>

<? } else { ?>

    <?if(!empty($results)) { ?>
        <?for($i=0; $i<count($results); $i++) { ?>
            <img src="https://2df79e695acdb7549107-880e37d91bcd6aa1176c75eb5abedb5a.ssl.cf5.rackcdn.com/blog/<?=$results[$i]['AppBlogPost']['id'];?>_main.jpg" onError="this.src='/img/blog/missing.png';" style="width: 100%;" />
            <br />
            ID:<br />
            <?=$results[$i]['AppBlogPost']['id'];?><br /><br />
            TITLE: <br />
            <?=$results[$i]['AppBlogPost']['title'];?><br /><br />
            BODY:<br />
            <?=$results[$i]['AppBlogPost']['body'];?><br /><br />
            CATEGORIES:<br />
            <?=$results[$i][0]['categories'];?><br /><br />
            PUBLISH DATE:<br />
            <?=$results[$i]['AppBlogPost']['post_date'];?><br />
            <a href="<?=trim($results[$i]['AppBlogPost']['permalink']);?>-<?=$results[$i]['AppBlogPost']['id'];?>">LINK</a>
            <hr />
        <? } ?>
    <? } else { ?>
        <div class="blog_no_more_results">
            - No posts found
        </div>
    <? } ?>
<? } ?>
