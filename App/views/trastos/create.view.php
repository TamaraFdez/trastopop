<?php loadPartial('head') ?>
<?php loadPartial('navbar') ?>
<?php loadPartial('top-banner') ?>
<!-- Publicar un Artículo Formulario -->

<?php
//  inspect($errors);
?>
<section class="flex justify-center items-center mt-20">
  <div class="bg-white p-8 rounded-lg shadow-md w-full md:w-600 mx-6">
    <h2 class="text-4xl text-center font-bold mb-4">Publicar un Anuncio</h2>
    <!-- <div class="message bg-red-100 p-3 my-3">This is an error message.</div>
        <div class="message bg-green-100 p-3 my-3">
          This is a success message.
        </div> -->
    <form method="POST" action="/trasto" enctype="multipart/form-data">

      <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
        Información del Artículo
      </h2>
      <div class="mb-4">
        <label for="title">Título</label>
        <input type="text" name="title" id="title" value="<?= $data['title'] ?? '' ?>" placeholder="Título del Artículo" class="w-full px-4 py-2 border rounded focus:outline-none" />
        <?php if (isset($errors['title'])) : ?>
          <div class="message bg-red-100 p-3 my-3"><?= $errors['title'] ?></div>
        <?php endif ?>
      </div>

      <div class="mb-4">
        <label for="decription">Descripción:</label>
        <textarea name="description" placeholder="Descripción del Artículo" class="w-full px-4 py-2 border rounded focus:outline-none"><?= $data['description'] ?? '' ?></textarea>
        <?php if (isset($errors['description'])) : ?>
          <div class="message bg-red-100 p-3 my-3"><?= $errors['description'] ?></div>
        <?php endif ?>
      </div>
      <div class="mb-4">
        <textarea name="details" placeholder="Detalles del Artículo" class="w-full px-4 py-2 border rounded focus:outline-none"><?= $data['details'] ?? '' ?></textarea>
      </div>
      <div class="mb-4">
        <input type="text" name="price" value="<?= $data['price'] ?? '' ?>" placeholder="Precio" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <div class="mb-4">
        <input type="text" name="condition" placeholder="Condición" value="<?= $data['condition'] ?? '' ?>" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <div class="mb-4">
        <input type="text" name="category" placeholder="Categoría" value="<?= $data['category'] ?? '' ?>" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <div class="mb-4">
        <input type="text" name="tags" value="<?= $data['tags'] ?? '' ?>" placeholder="Etiquetas" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
        Información de Contacto y Ubicación
      </h2>
      <div class="mb-4">
        <input type="text" name="seller" value="<?= $data['seller'] ?? '' ?>" placeholder="Nombre del Vendedor" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <div class="mb-4">
        <input type="text" name="address" value="<?= $data['address'] ?? '' ?>" placeholder="Dirección" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <div class="mb-4">
        <input type="text" name="city" placeholder="Ciudad" value="<?= $data['city'] ?? '' ?>" class="w-full px-4 py-2 border rounded focus:outline-none" />
        <?php if (isset($errors['city'])) : ?>
          <div class="message bg-red-100 p-3 my-3"><?= $errors['city'] ?></div>
        <?php endif ?>
      </div>
      <div class="mb-4">
        <input type="text" name="state" value="<?= $data['state'] ?? '' ?>" placeholder="Estado" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <div class="mb-4">
        <input type="text" name="phone" value="<?= $data['phone'] ?? '' ?>" placeholder="Teléfono" class="w-full px-4 py-2 border rounded focus:outline-none" />
      </div>
      <div class="mb-4">
        <input type="email" name="email" value="<?= $data['email'] ?? '' ?>" placeholder="Correo Electrónico para Contacto" class="w-full px-4 py-2 border rounded focus:outline-none" />
        <?php if (isset($errors['email'])) : ?>
          <div class="message bg-red-100 p-3 my-3"><?= $errors['email'] ?></div>
        <?php endif ?>
      </div>
      <div>
      Foto del trasto: 
      <input type="file" name="foto"><br> <!-- Campo de carga de archivos -->
      <input type="submit" value="img">
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