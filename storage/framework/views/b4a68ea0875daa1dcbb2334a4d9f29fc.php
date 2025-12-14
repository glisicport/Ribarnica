<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promena Lozinke</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'glavna': '#4f46e5',
                        'glavna-hover': '#4338ca',
                        'pozadina': '#eef2ff',
                    },
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>
<body class="bg-pozadina">

<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        
        <!-- Header -->
        <div class="mb-8">
            <a href="<?php echo e(route('profil.edit')); ?>" class="flex items-center text-glavna hover:text-glavna-hover font-medium transition duration-200 mb-4">
                <i class="fas fa-arrow-left mr-2"></i> Vrati se nazad
            </a>
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">
                Promena Lozinke
            </h1>
            <p class="text-gray-500 mt-2">Ažurirajte vašu lozinku da ostanete sigurni na vašem nalogu.</p>
        </div>

        <!-- Success Message -->
        <?php if(session('status')): ?>
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg flex items-start" role="alert">
                <i class="fas fa-check-circle mr-3 mt-0.5 flex-shrink-0"></i>
                <span><?php echo e(session('status')); ?></span>
            </div>
        <?php endif; ?>

        <!-- Change Password Form -->
        <form action="<?php echo e(route('profil.change-password.update')); ?>" method="POST" class="bg-white shadow-lg rounded-lg p-8 space-y-6">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <!-- Current Password -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="current_password">
                    Trenutna Lozinka *
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                        <i class="fas fa-lock text-gray-400"></i>
                    </span>
                    <input class="w-full border-2 rounded-lg py-3 px-12 text-gray-800 focus:outline-none focus:ring-2 focus:ring-glavna focus:border-glavna transition duration-150
                                  <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php else: ?> border-gray-300 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           id="current_password" 
                           name="current_password" 
                           type="password" 
                           placeholder="Unesite vašu trenutnu lozinku"
                           required>
                </div>
                <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-xs italic mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- New Password -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="password">
                    Nova Lozinka *
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                        <i class="fas fa-key text-gray-400"></i>
                    </span>
                    <input class="w-full border-2 rounded-lg py-3 px-12 text-gray-800 focus:outline-none focus:ring-2 focus:ring-glavna focus:border-glavna transition duration-150
                                  <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php else: ?> border-gray-300 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           id="password" 
                           name="password" 
                           type="password" 
                           placeholder="Najmanje 8 karaktera"
                           required>
                </div>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-xs italic mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <p class="text-gray-500 text-xs mt-2">
                    <i class="fas fa-info-circle mr-1"></i> Lozinka mora imati najmanje 8 karaktera
                </p>
            </div>

            <!-- Confirm New Password -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="password_confirmation">
                    Potvrdite Novu Lozinku *
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                        <i class="fas fa-lock text-gray-400"></i>
                    </span>
                    <input class="w-full border-2 rounded-lg py-3 px-12 text-gray-800 focus:outline-none focus:ring-2 focus:ring-glavna focus:border-glavna transition duration-150
                                  <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php else: ?> border-gray-300 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           type="password" 
                           placeholder="Ponovite vašu novu lozinku"
                           required>
                </div>
                <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-xs italic mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Security Notice -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-start">
                    <i class="fas fa-shield-alt text-blue-600 mt-1 mr-3 flex-shrink-0"></i>
                    <div>
                        <p class="text-sm text-blue-900 font-semibold">Saveti za sigurnu lozinku:</p>
                        <ul class="text-xs text-blue-800 mt-2 space-y-1 list-disc list-inside">
                            <li>Koristite kombinaciju velikih i malih slova</li>
                            <li>Dodajte brojeve i specijalne znakove</li>
                            <li>Izbegavajte lične informacije</li>
                            <li>Nikada ne delite vašu lozinku</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 pt-4">
                <button type="submit" class="flex-1 py-3 text-white font-bold rounded-lg bg-gradient-to-r from-glavna to-indigo-500 hover:from-glavna-hover hover:to-indigo-600 focus:outline-none focus:ring-4 focus:ring-glavna/50 transition duration-300 transform hover:scale-[1.01]">
                    <i class="fas fa-save mr-2"></i> Promeni Lozinku
                </button>
                <a href="<?php echo e(route('profil.edit')); ?>" class="py-3 px-6 text-gray-700 font-bold rounded-lg bg-gray-200 hover:bg-gray-300 focus:outline-none transition duration-300">
                    <i class="fas fa-times mr-2"></i> Otkaži
                </a>
            </div>
        </form>

    </div>
</div>

</body>
</html>
<?php /**PATH /var/www/html/resources/views/user/profile/change-password.blade.php ENDPATH**/ ?>