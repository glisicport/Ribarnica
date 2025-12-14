<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija - Sign Up</title>
    <!-- Uključivanje Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'glavna': '#4f46e5', // Indigo-600
                        'glavna-hover': '#4338ca', // Indigo-700
                        'pozadina': '#eef2ff', // Indigo-50
                    },
                }
            }
        }
    </script>
    <!-- Uključivanje Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" xintegrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<div class="bg-pozadina flex items-center justify-center min-h-screen p-4">

    <!-- Kontejner za formu -->
    <div class="w-full max-w-lg">
        
        <a href="/" class="flex items-center text-glavna hover:text-glavna-hover mb-4 font-medium transition duration-200">
            <i class="fas fa-arrow-left mr-2"></i> Vrati se nazad
        </a>

        <!-- Kartica za registraciju -->
        <div class="bg-white shadow-2xl rounded-xl p-8 sm:p-10 border border-gray-200/50">
            
            <h2 class="text-4xl font-extrabold text-center text-gray-900 mb-2 tracking-tight">
                Kreirajte nalog
            </h2>
            <p class="text-center text-gray-500 mb-8">
                Registrujte se i počnite sa kupovanjem.
            </p>

            <!-- Prikazivanje statusne poruke -->
            <?php if(session('status')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline"><?php echo e(session('status')); ?></span>
                </div>
            <?php endif; ?>

            <!-- Forma za registraciju -->
            <form action="<?php echo e(route('registracija.store')); ?>" method="POST" class="space-y-6">
                <?php echo csrf_field(); ?> 

                <!-- Polje za Ime i prezime -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1" for="name">
                        Ime i prezime
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                            <i class="fas fa-user text-gray-400 text-lg"></i>
                        </span>
                        <input class="w-full border-2 rounded-lg py-3 px-12 text-gray-800 leading-tight focus:outline-none focus:ring-2 focus:ring-glavna focus:border-glavna transition duration-150 
                                      <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php else: ?> border-gray-300 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               id="name" 
                               name="name" 
                               type="text" 
                               placeholder="Vaše ime i prezime"
                               value="<?php echo e(old('name')); ?>"
                               required>
                    </div>
                    <!-- Prikazivanje greške za polje Ime -->
                    <?php $__errorArgs = ['name'];
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

                <!-- Polje za E-mail -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1" for="email">
                        E-mail adresa
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                            <i class="fas fa-envelope text-gray-400 text-lg"></i>
                        </span>
                        <input class="w-full border-2 rounded-lg py-3 px-12 text-gray-800 leading-tight focus:outline-none focus:ring-2 focus:ring-glavna focus:border-glavna transition duration-150 
                                      <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php else: ?> border-gray-300 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               id="email" 
                               name="email" 
                               type="email" 
                               placeholder="unesite@vasu.adresu.com"
                               value="<?php echo e(old('email')); ?>"
                               required>
                    </div>
                    <!-- Prikazivanje greške za polje E-mail -->
                    <?php $__errorArgs = ['email'];
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

                <!-- Polje za Lozinku -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1" for="password">
                        Lozinka
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                            <i class="fas fa-lock text-gray-400 text-lg"></i>
                        </span>
                        <input class="w-full border-2 rounded-lg py-3 px-12 text-gray-800 leading-tight focus:outline-none focus:ring-2 focus:ring-glavna focus:border-glavna transition duration-150
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
                    <!-- Prikazivanje greške za polje Lozinka -->
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
                </div>

                <!-- Polje za Potvrdu lozinke -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1" for="password_confirmation">
                        Potvrdite lozinku
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                            <i class="fas fa-lock text-gray-400 text-lg"></i>
                        </span>
                        <input class="w-full border-2 rounded-lg py-3 px-12 text-gray-800 leading-tight focus:outline-none focus:ring-2 focus:ring-glavna focus:border-glavna transition duration-150
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
                               placeholder="Ponovite lozinku"
                               required>
                    </div>
                    <!-- Prikazivanje greške za potvrdu lozinke -->
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

                <!-- Dugme za Registraciju -->
                <button class="w-full py-3 mt-4 text-white font-bold rounded-lg 
                                bg-gradient-to-r from-glavna to-indigo-500 
                                hover:from-glavna-hover hover:to-indigo-600 
                                focus:outline-none focus:ring-4 focus:ring-glavna/50 
                                transition duration-300 ease-in-out transform hover:scale-[1.01]" 
                        type="submit">
                    <i class="fas fa-user-plus mr-2"></i> Registruj se
                </button>
            </form>

            <!-- Link za prijavu -->
            <p class="text-center text-gray-500 text-base mt-6">
                Već imate nalog? 
                <a class="text-glavna hover:text-glavna-hover font-semibold transition duration-150" href="<?php echo e(route('prijava')); ?>">
                    Prijavite se!
                </a>
            </p>

        </div>
        
        <!-- Footer -->
        <p class="text-center text-gray-400 text-xs mt-6">
            &copy;2025 Naziv Vaše Kompanije. Sva prava zadržana.
        </p>
    </div>

</body>
</html>
<?php /**PATH /var/www/html/resources/views/prijava/register.blade.php ENDPATH**/ ?>