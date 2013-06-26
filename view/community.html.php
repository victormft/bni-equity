<?php

use Equity\Library\Text,
    Equity\Core\View;

$bodyClass = 'community about';

include 'view/prologue.html.php';
include 'view/header.html.php';
?>

<!--    <div id="sub-header">
        <div>
            <h2 style="margin-bottom:5px">  <?php echo $this['description']; ?>  </h2>
        </div>
    </div>
-->
<div id="main" style="margin-top: 20px;">
        
    <div class="left-bar">
        <div class="user-type-wraper">
            <div class="user-type">
                <div class="options">
                    <div class="option"><a href="/people">Todos</a></div>
                    <div class="option"><a href="/people/investors">Investidores</a></div>
                    <div class="option"><a href="/people/entrepreneurs">Empreendedores</a></div>
                </div>
            </div>
        </div>
        
    </div>
    
    <div class="content-community"> <!--antes class era side em profile.css-->
        
        <h2>Comunidade</h2>
        
        <div class="content-community-content">
            <div class="filters">
                <div class="filter-name">
                    <a href="#" class="filter_link" data-url="">Person</a>
                </div>
                <div class="filter-investments" title="">
                    <a href="" class="filter_link" data-url="">Investments</a>
                </div>
                <div class="filter-followers" title="">
                    <a href="" class="filter_link" data-url="">Followers</a>
                </div>
                <div class="filter-path">
                    <a href="" class="filter_link" data-url="">Path</a>
                </div>
            </div>
            
            <div class="total-count">num de pessoas</div>
            
            <div class="user">
                <div class="user-info">
                    <div class="pic"><a href="https://angel.co/jameschase"><img alt="James Chase" class="angel_image" src="https://s3.amazonaws.com/photos.angel.co/users/275793-medium_jpg?1364514645"></a></div>
                    <div class="right">
                        <div class="name">
                            <a href="https://angel.co/jameschase">James Chase</a>
                        </div>
                        <div class="cb"></div>
                        <div class="resume">
                            VP Engineering at four start ups; two were acquired by public companies. Now looking for my next start up challenge. See <a href="http://jameschase.com">http://jameschase.com</a>.
                        </div>
                        <div class="tags">
                            <a href="https://angel.co/san-francisco">San Francisco</a> · <a href="https://angel.co/entrepreneur-1">Entrepreneur</a>
                        </div>

                    </div>
                </div>
                
                <div class="user-stats">
                    <div class="user-investments">
                        <div class="count">
                            <a href="https://angel.co/jameschase" target="_blank">
                                <strong>0</strong>
                            </a>
                        </div>
                    </div>
                    <div class="user-followers">
                        <div class="count">
                            <a href="https://angel.co/jameschase/followers" target="_blank">
                                <strong>5</strong>
                            </a>
                        </div>
                    </div>
                
                    <div class="user-paths">
                        <div class="count">
                            <div class=" dp44 paths fre77 render_single _a">
                                <div class="packed">
                                    <div class="network_item tiptip_left">
<!--                                        <div class="network_pic">
                                            <img alt="" height="9" src="/images/icons/path_icon.png?1372126784" width="13">
                                        </div>-->
                                        <div class="link_label">3+</div>
                                    </div>
                                </div>
                                <script type="text/javascript">
                                //<![CDATA[
                                _i("paths","render_single")
                                //]]>
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
        <?php //echo new View('view/community/sharemates.html.php', $this) ?>
        <?php //echo new View('view/community/investors.html.php', $this) ?>
    </div>
</div>

<?php include 'view/footer.html.php' ?>
<?php include 'view/epilogue.html.php' ?>


<style>
    div.left-bar {
        background-color: white;
        float: left;
        margin-right: 30px;
        width: 200px;
        height: 600px;
    }
    div.left-bar > div.user-type-wraper {
        background-color: wheat;
        margin-bottom: 25px;
    }
    div.left-bar > div.user-type-wraper > div.user-type > div.options > div.option > a {
        display: block;
        padding: 8px 12px;
    }
    div.content-community {
        float: right;
        width: 700px;
    }
    div.content-community > div.content-community-content {
        background-color: white;
        height: 500px;
    }
    
    div.content-community > div.content-community-content > div.filters{
        background-color: burlywood;
        padding: 10px;
        float: left;
        width: 100%;
    }
    
    div.content-community > div.content-community-content > div.filters > div.filter-name, div.filter-investments, div.filter-followers, div.filter-path{
        float: left;
        color: red;
    }
    div.content-community > div.content-community-content > div.filters > div.filter-name{
        width: 50%;
    }
    div.content-community > div.content-community-content > div.filters > div.filter-investments{
        width: 16%;
    }
    div.content-community > div.content-community-content > div.filters > div.filter-followers{
        width: 16%;
    }
    div.content-community > div.content-community-content > div.filters > div.filter-path{
        width: 16%;
    }
    div.content-community > div.content-community-content > div.total-count, div.user{
        padding: 10px;
        float: left;
        width: 100%;
        border-bottom: solid grey;
    }
    div.content-community > div.content-community-content > div.user > div.user-info {
        float: left;
        width: 48%;
    }
    div.content-community > div.content-community-content > div.user > div.user-info > div.pic img {
        max-height: 37px;
        max-width: 37px;
        float: left;
    }
    div.content-community > div.content-community-content > div.user > div.user-info > div.right {
        padding-left: 50px;
    }
    div.content-community > div.content-community-content > div.user > div.user-stats {
        float: left;
        width: 310px;
        padding-left: 10px;
    }
    div.content-community > div.content-community-content > div.user > div.user-stats > div.user-investments, div.user-followers, div.user-paths {
        float: left;
        text-align: right;
    }
    div.content-community > div.content-community-content > div.user > div.user-stats > div.user-investments {
        width: 70px;
    }
    div.content-community > div.content-community-content > div.user > div.user-stats > div.user-followers {
        width: 100px;
    }
    div.content-community > div.content-community-content > div.user > div.user-stats > div.user-paths {
        width: 85px;
    }
    
    
</style>