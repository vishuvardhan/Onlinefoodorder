<ul class="nav menu">
    <li class="<?php if($_SESSION['page']=="orders") { ?> active <?php } ?>"><a href="adminHome.php">
            <svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use>
            </svg> Orders
        </a>
    </li>


    <li class="parent <?php if($_SESSION['page']=="types") { ?> active <?php } ?>">
        <a href="#">
            <span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down">
                <use xlink:href="#stroked-chevron-down"></use></svg></span> Food Types 
        </a>
        <ul class="children collapse" id="sub-item-1">
            <li>
                <a class="" href="types.php">
                    <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> List Types
                </a>
            </li>
            <li>
                <a class="" href="addType.php">
                    <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Add Type
                </a>
            </li>

        </ul>
    </li>
    <li class="parent <?php if($_SESSION['page']=="category") { ?> active <?php } ?>">
        <a href="#">
            <span data-toggle="collapse" href="#sub-item-2"><svg class="glyph stroked chevron-down">
                <use xlink:href="#stroked-chevron-down"></use></svg></span> Food Category
        </a>
        <ul class="children collapse" id="sub-item-2">
            <li>
                <a class="" href="categories.php">
                    <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> List Categories
                </a>
            </li>
            <li>
                <a class="" href="addCategory.php">
                    <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>Add Category
                </a>
            </li>

        </ul>
    </li>
    <li class="parent <?php if($_SESSION['page']=="stock") { ?> active <?php } ?>">
        <a href="#">
            <span data-toggle="collapse" href="#sub-item-3"><svg class="glyph stroked chevron-down">
                <use xlink:href="#stroked-chevron-down"></use></svg></span> Stocks
        </a>
        <ul class="children collapse" id="sub-item-3">
            <li>
                <a class="" href="stocks.php">
                    <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> List Stocks
                </a>
            </li>
            <li>
                <a class="" href="addStocks.php">
                    <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>Add Stock
                </a>
            </li>

        </ul>
    </li>
    
    <li class="<?php if($_SESSION['page']=="contact") { ?> active <?php } ?>"><a href="contactQueries.php"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use>
            </svg> Contact Queries
        </a>
    </li>
</ul>



