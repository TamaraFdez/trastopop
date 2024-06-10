<?php loadPartial('head') ?>
<?php loadPartial('navbar') ?>
<div class="flex justify-center items-center mt-20">
      <div class="bg-white p-8 rounded-lg shadow-md w-full md:w-500 mx-6">
        <h2 class="text-4xl text-center font-bold mb-4">Registrarse</h2>
      
        <form method="POST" action="/auth/create">
          <div class="mb-4">
            <input
              type="text"
              name="name"
              placeholder="Nombre Completo"
              class="w-full px-4 py-2 border rounded focus:outline-none"
            /> 
              <?php if (isset($errors['name'])) : ?>
          <div class="message bg-red-100 p-3 my-3"><?= $errors['name'] ?></div>
        <?php endif ?>
          </div>
          <div class="mb-4">
            <input
              type="email"
              name="email"
              placeholder="Correo Electrónico"
              class="w-full px-4 py-2 border rounded focus:outline-none"
            />
            <?php if (isset($errors['email'])) : ?>
          <div class="message bg-red-100 p-3 my-3"><?= $errors['email'] ?></div>
        <?php endif ?>
          </div>
          <div class="mb-4">
            <input
              type="text"
              name="city"
              placeholder="Ciudad"
              class="w-full px-4 py-2 border rounded focus:outline-none"
            />
            
          </div>
          <div class="mb-4">
            <input
              type="text"
              name="state"
              placeholder="Estado"
              class="w-full px-4 py-2 border rounded focus:outline-none"
            />
          </div>
          <div class="mb-4">
            <input
              type="password"
              name="password"
              placeholder="Contraseña"
              class="w-full px-4 py-2 border rounded focus:outline-none"
            />
            <?php if (isset($errors['password'])) : ?>
          <div class="message bg-red-100 p-3 my-3"><?= $errors['password'] ?></div>
        <?php endif ?>
          </div>
          <div class="mb-4">
            <input
              type="password"
              name="password_confirmation"
              placeholder="Confirmar Contraseña"
              class="w-full px-4 py-2 border rounded focus:outline-none"
            />
            <?php if (isset($errors['passwords'])) : ?>
          <div class="message bg-red-100 p-3 my-3"><?= $errors['passwords'] ?></div>
        <?php endif ?>
          </div>
          <button
            type="submit"
            class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded focus:outline-none"
          >
            Registrarse
          </button>

          <p class="mt-4 text-gray-500">
            ¿Ya tienes una cuenta?
            <a class="text-blue-900" href="/auth/login">Iniciar Sesión</a>
          </p>
        </form>
      </div>
    </div>
<?php loadPartial('footer') ?>