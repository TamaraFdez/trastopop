
<?php loadPartial('head') ?>
<?php loadPartial('navbar') ?>
<?php loadPartial('top-banner') ?>

<!-- Trasto Listings -->
<section>
    <div class="container mx-auto p-4 mt-4">
        <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3">Trastos Recientes</div>
       <?php loadPartial('message'); ?>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <?php foreach($trastos as $trasto): ?>
            <div class="rounded-lg shadow-md bg-white">
                <div class="p-4">
                    <h2 class="text-xl font-semibold"><?= $trasto->title ?></h2>
                    <p class="text-gray-700 text-lg mt-2">
                        <?= $trasto->description ?>
                    </p>
                    <ul class="my-4 bg-gray-100 p-4 rounded">
                    <li class="mb-2"><strong>Imagen:</strong><a data-fslightbox='<?= $trasto->title ?>' href="/images/<?= $trasto->imgurl ?>"><img src="/thumbnail/<?= $trasto->thumbnail_imgurl ?>" alt="<?= $trasto->title ?>"></a> </li>
                        <li class="mb-2"><strong>Precio:</strong> <?= $trasto->price ?>€</li>
                        <li class="mb-2">
                            <strong>Ubicación:</strong> <?= $trasto->city ?>
                            <!-- <span class="text-xs bg-blue-500 text-white rounded-full px-2 py-1 ml-2">Local</span> -->
                        </li>
                        <li class="mb-2">
                            <strong>Categoria:</strong> <span><?= $trasto->category ?></span>
        
                        </li>
                        <li class="mb-2">
                            <strong>Tags:</strong><span><?= $trasto->tags ?></span>
        
                        </li>
                    </ul>
                    <a href="/trasto/<?=$trasto->id?>" class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
                        Detalles
                    </a>
                </div>
            </div>
                <?php endforeach ?>
        </div>
   
</section>
<?php loadPartial('bottom-banner') ?>
<?php loadPartial('footer') ?>