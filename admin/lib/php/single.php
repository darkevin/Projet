<?php
$id = filter_input(INPUT_POST, 'input'); 
$tab = explode("_", $id);
$a = $tab[0];
$b = $tab[1]+1;
?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Gallerie Photos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="py-5 text-white">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 p-0">
                            <div id="carousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner" role="listbox">
                                    <div class="carousel-item active">
                                        <img  class="mx-auto d-block" src="images/montres/<?=$a.'_1'?>.jpg" data-holder-rendered="true">
                                    </div>
                                    <?php for ($i=2; $i<$b; $i++){ ?>
                                        <div class="carousel-item">
                                            <img  class="mx-auto d-block" src="images/montres/<?=$a.'_'.$i?>.jpg" data-holder-rendered="true">
                                        </div>
                                    <?php } ?>
                                </div>
                                <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
                                <a class="carousel-control-next" href="#carousel" role="button" data-slide="next"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>       