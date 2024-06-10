<?php loadPartial('head') ?>
<?php loadPartial('navbar') ?>
<?php loadPartial('top-banner') ?>
<!-- Editar un Artículo Formulario -->
<section class="flex justify-center items-center mt-20">
  <div class="bg-white p-8 rounded-lg shadow-md w-full md:w-600 mx-6">
    <h2 class="text-4xl text-center font-bold mb-4">Editar un Anuncio</h2>
 
    <form method="POST" action="/trasto/<?=$trasto->id?>" enctype="multipart/form-data">
  
  <input type="hidden" name="_method" value="PUT">
      <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
        Información del Artículo
      </h2>
      <div class="mb-4">
        <label for="title">Título</label>
        <input type="text" name="title" id="title" value="<?= $trasto->title ?? '' ?>" placeholder="Título del Artículo" class="w-full px-4 py-2 border rounded focus:outline-none" />
        <?php if (isset($errors['title'])) : ?>
          <div class="message bg-red-100 p-3 my-3"><?= $errors['title'] ?></div>
        <?php endif ?>
      </div>

      <div class="mb-4">
        <label for="decription">Descripción:</label>
        <textarea name="description" placeholder="Descripción del Artículo" class="w-full px-4 py-2 border rounded focus:outline-none"><?= $trasto->description ?? '' ?></textarea>
        <?php if (isset($errors['description'])) : ?>
          <div class="message bg-red-100 p-3 my-3"><?= $errors['description'] ?></div>
        <?php endif ?>
      </div>
      <div class="mb-4">
        <textarea name="details" placeholder="Detalles del Artículo" class="w-full px-4 py-2 border rounded focus:outline-none"><?= $trasto->details ?? '' ?></textarea>
      </div>
      <div class="mb-4">
        <input type="text" name="price" value="<?= $trasto->price ?? '' ?>" placeholder="Precio" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <div class="mb-4">
        <input type="text" name="condition" placeholder="Condición" value="<?= $trasto->condition ?? '' ?>" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <div class="mb-4">
        <input type="text" name="category" placeholder="Categoría" value="<?= $trasto->category ?? '' ?>" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <div class="mb-4">
        <input type="text" name="tags" value="<?= $trasto->tags ?? '' ?>" placeholder="Etiquetas" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
        Información de Contacto y Ubicación
      </h2>
      <div class="mb-4">
        <input type="text" name="seller" value="<?= $trasto->seller ?? '' ?>" placeholder="Nombre del Vendedor" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <div class="mb-4">
        <input type="text" name="address" value="<?= $trasto->address ?? '' ?>" placeholder="Dirección" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <div class="mb-4">
        <input type="text" name="city" placeholder="Ciudad" value="<?= $trasto->city ?? '' ?>" class="w-full px-4 py-2 border rounded focus:outline-none" />
        <?php if (isset($errors['city'])) : ?>
          <div class="message bg-red-100 p-3 my-3"><?= $errors['city'] ?></div>
        <?php endif ?>
      </div>
      <div class="mb-4">
        <input type="text" name="state" value="<?= $trast->state ?? '' ?>" placeholder="Estado" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <div class="mb-4">
        <input type="text" name="phone" value="<?= $trasto->phone ?? '' ?>" placeholder="Teléfono" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <div class="mb-4">
        <input type="email" name="email" value="<?= $trasto->email ?? '' ?>" placeholder="Correo Electrónico para Contacto" class="w-full px-4 py-2 border rounded focus:outline-none" />
        <?php if (isset($errors['email'])) : ?>
          <div class="message bg-red-100 p-3 my-3"><?= $errors['email'] ?></div>
        <?php endif ?>
      </div>
      <div>
      Foto del trasto: 
      <input type="file" name="foto" value="<?= $trasto->imgurl?>"><br> <!-- Campo de carga de archivos -->
     
      </div>
      <button class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none">
        Guardar
      </button>
      <a href="/" class="block text-center w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded focus:outline-none">
        Cancelar
      </a>
    </form>
  </div>
</section>

<?php loadPartial('footer') ?>