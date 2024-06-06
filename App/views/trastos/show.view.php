<?php loadPartial('head') ?>
<?php loadPartial('navbar') ?>
<?php loadPartial('top-banner') ?>
<?php 

?>
<section class="container mx-auto p-4 mt-4">
    <div class="rounded-lg shadow-md bg-white p-3">
        <div class="flex justify-between items-center">
            <a class="block p-4 text-blue-700" href="/trastos">
                <i class="fa fa-arrow-alt-circle-left"></i>
                Volver a los Listados
            </a>
            <div class="flex space-x-4 ml-4">
                <a href="/edit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded">Editar</a>
                <!-- Delete Form -->
                <form method="POST">
                    <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded">
                        Eliminar
                    </button>
                </form>
                <!-- End Delete Form -->
            </div>
        </div>
        <div class="p-4">
            <h2 class="text-xl font-semibold"><?= $trasto->title ?></h2>
            <p class="text-gray-700 text-lg mt-2">
                <?= $trasto->description ?>
            </p>
            <ul class="my-4 bg-gray-100 p-4">
            <li class="mb-2"><strong>Imagen:</strong> <img src="/images/<?= $trasto->imgurl ?>" alt="Imagen"> </li>
                <li class="mb-2"><strong>Precio:</strong> <?= $trasto->price ?></li>
                <li class="mb-2">
                    <strong>Ubicación:</strong> <?= $trasto->city ?>
                    <!-- <span class="text-xs bg-blue-500 text-white rounded-full px-2 py-1 ml-2">Local</span> -->
                </li>
                <li class="mb-2">
                    <strong>Categoria:</strong> <span><?= $trasto->category ?></span>
                    
                </li>
                <li class="mb-2">
                    <strong>Tags:</strong> <span><?= $trasto->tags?></span>
                    <span>Deporte</span>
                </li>
            </ul>
        </div>
    </div>
</section>

<section class="container mx-auto p-4">
    <h2 class="text-xl font-semibold mb-4">Detalles del Trasto</h2>
    <div class="rounded-lg shadow-md bg-white p-4">
        <h3 class="text-lg font-semibold mb-2 text-blue-500">
            Características
        </h3>
        <p>
           <?= $trasto->details ?>
        </p>
        <h3 class="text-lg font-semibold mt-4 mb-2 text-blue-500">Estado</h3>
        <p><?= $trasto->condition?></p>
    </div>
    <p class="my-5">Contacta al vendedor por email para más información.</p>
    <a href="mailto:<?= $trasto->email ?>" class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium cursor-pointer text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
        Contactar Vendedor
    </a>
</section>


<?php loadPartial('bottom-banner') ?>
<?php loadPartial('footer') ?>