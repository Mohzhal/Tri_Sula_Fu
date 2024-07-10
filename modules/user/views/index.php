<!DOCTYPE html>
<html lang="en"  class="scroll-smooth ">
<head>
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRISULA || TRACKOUT</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Scribble&display=swap" rel="stylesheet">  
     <link rel="icon" href="<?= base_url('assets/'); ?>/img/logo.png" type="image/x-icon">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>dict/output.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>dict/animiate.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>dict/custom.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>alert/sweetalert2.css">
    <style>
        /* Ensure the cart sidebar appears above other content */
        #slide {
            z-index: 9999;
        }
        .swal2-container{
            z-index: 10000000000000000000000000;
        }
    </style>
    <style>
        .text-danger {
            color: #f1416c !important;
        }
        .size-12 {
          width: 3rem !important;
          height: 3rem !important;
      }
    </style>
    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
   </head>
<body>
<!-- CART -->
<!-- Keranjang belanja -->
<div id="slide" class="absolute hidden overflow-y-scroll right-0 z-[9999]">
    <div aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <div class="fixed inset-0 overflow-hidden flex items-center justify-end px-4 py-6">
            <div class="max-w-md w-full">
                <div class="bg-white shadow-xl h-full overflow-y-scroll rounded-lg overflow-auto">
                    <div class="px-4 py-6 sm:px-6">
                        <div class="flex items-start justify-between">
                            <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Shopping cart</h2>
                            <div class="ml-3 flex h-7 items-center">
                                <button type="button" class="relative -m-2 p-2 text-gray-400 hover:text-gray-500" <?= (isset($_SESSION[PREFIX_SESSION.'_id_user'])) ? 'onclick="toggleCart()"' : 'onclick="toggleLogin()"'; ?>>
                                    <span class="absolute -inset-0.5"></span>
                                    <span class="sr-only">Close panel</span>
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="mt-8 overflow-auto max-h-[calc(100vh-160px)]">
                            <div class="flow-root">
                                <ul role="list" id="cart-items" class="-my-6 divide-y divide-gray-200">
                                    <!-- Shopping cart items will be dynamically inserted here -->
                                    <?php $total = 0; ?>
                                    <?php if($cart) : ?>
                                        
                                        <?php foreach($cart AS $row) : ?>
                                            <?php $total += $row->harga; ?>
                                            <li class="py-6 flex">
                                                <img src="<?= image_check($row->gambar,'produk'); ?>" alt="" class="h-10 w-10 rounded-full flex-shrink-0 object-cover" />
                                                <div class="ml-4 flex-1 flex flex-col">
                                                    <div>
                                                        <div class="flex justify-between text-base font-medium text-gray-900">
                                                            <h3><?= $row->nama; ?></h3>
                                                            <p class="ml-4">$<?= number_format($row->harga,2,",","."); ?></p>
                                                        </div>
                                                        <p class="mt-1 text-sm text-gray-500">Quantity: 1</p>
                                                    </div>
                                                    <button class="text-red-500 hover:text-red-700 mt-2 self-end" onclick="removeFromCart(this, <?= $row->harga ?>,<?= $row->id_cart; ?>)">Remove</button>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php endif;?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
                        <div class="flex justify-between text-base font-medium text-gray-900">
                            <p>Subtotal</p>
                            <input type="hidden" id="real_total" value="<?= $total; ?>">
                            <p id="cart-subtotal">$<?= number_format($total,2,",","."); ?></p>
                        </div>
                        <p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at checkout.</p>
                        <div class="mt-6">
                            <a id="btn_checkout" href="<?= base_url('payment'); ?>" __blank class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700" <?= (!$cart) ? 'disabled' : ''; ?>>Checkout</a>
                        </div>
                        <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                            <p>
                                or
                                <button type="button" class="font-medium text-indigo-600 hover:text-indigo-500" <?= (isset($_SESSION[PREFIX_SESSION.'_id_user'])) ? 'onclick="toggleCart()"' : 'onclick="toggleLogin()"'; ?>>
                                    Continue Shopping
                                    <span aria-hidden="true"> &rarr;</span>
                                </button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="slide_login" class="absolute hidden overflow-y-scroll right-0 z-[9999]">
    <div aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <div class="fixed inset-0 overflow-hidden flex items-center justify-end px-4 py-6">
            <div class="max-w-md w-full">
                <div class="bg-white shadow-xl h-full overflow-y-scroll rounded-lg overflow-auto">
                    <div class="px-4 py-6 sm:px-6">
                        <div class="flex items-start justify-between">
                            <h2 class="text-lg font-medium text-gray-900" id="slide-login-over-title">Login</h2>
                            <div class="ml-3 flex h-7 items-center">
                                <button type="button" class="relative -m-2 p-2 text-gray-400 hover:text-gray-500" <?= (isset($_SESSION[PREFIX_SESSION.'_id_user'])) ? 'onclick="toggleCart()"' : 'onclick="toggleLogin()"'; ?>>
                                    <span class="absolute -inset-0.5"></span>
                                    <span class="sr-only">Close panel</span>
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="mt-8 overflow-auto max-h-[calc(100vh-160px)]">
                            <div class="flow-root">
                                <div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
                                    <span class="font-medium">Anda harus login untuk melanjutkan pemesanan!</span>
                                </div>
                                <form id="form_login" action="<?= base_url('user_function/login'); ?>" method="POST" class="bg-transparent shadow-teal-400 rounded-lg  shadow-md p-6 showin">

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="login_email">Email</label>
                                        <input class="border rounded-md py-2 px-3 w-full focus:outline-none focus:border-blue-400" type="email" id="login_email" name="email" placeholder="Masukkan Email..." required autocomplete="off">
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="login_password">Password</label>
                                        <input class="border rounded-md py-2 px-3 w-full focus:outline-none focus:border-blue-400" type="password" id="login_password" name="password" placeholder="Masukkan Password..." required autocomplete="off">
                                    </div>
                                 
                                    <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button" onclick="submit_form(this,'#form_login',0)" id="btn_login">Masuk</button>
                                    <button class="text-blue font-bold py-2 px-4" type="button" onclick="auth_tipe('register')">Daftar sekarang?</button>
                                </form>

                                <form id="form_register" action="<?= base_url('user_function/register'); ?>" method="POST" class="bg-transparent shadow-teal-400 rounded-lg  shadow-md p-6 hidin">
                                    
                                    <div class="mb-4" id="req_register_nama">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="register_nama">Nama</label>
                                        <input class="border rounded-md py-2 px-3 w-full focus:outline-none focus:border-blue-400" type="text" id="register_nama" name="nama" placeholder="Masukkan Nama..." required autocomplete="off">
                                    </div>

                                    <div class="mb-4" id="req_register_email">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="register_email">Email</label>
                                        <input class="border rounded-md py-2 px-3 w-full focus:outline-none focus:border-blue-400" type="email" id="register_email" name="email" placeholder="Masukkan Email..." required autocomplete="off">
                                    </div>

                                    <div class="mb-4" id="req_register_password">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="register_password">Password</label>
                                        <input class="border rounded-md py-2 px-3 w-full focus:outline-none focus:border-blue-400" type="password" id="register_password" name="password" placeholder="Masukkan Password..." required autocomplete="off">
                                    </div>
                                 
                                    <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button" onclick="submit_form(this,'#form_register',1)" id="btn_pendaftaran">Daftar</button>
                                    <button class="text-blue font-bold py-2 px-4" type="button" onclick="auth_tipe('login')">Masuk sekarang?</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




    <div  class="z-[999] fixed min-w-full ">
        <span class="font-semibold p-2 lg:text-2xl sm:font-bold  flex sm:text-lg  text-sm   text-black dark:text-white">TRISULA</span>
       
        <div class="flex top-0 absolute right-5 mt-3 gap-5">
            <!-- Click cart -->
            <div class="dark:w-7 p-1 dark:bg-white dark:rounded-md">
                <div <?= (isset($_SESSION[PREFIX_SESSION.'_id_user'])) ? 'onclick="toggleCart()"' : 'onclick="toggleLogin()"'; ?> class="w-5 cursor-pointer" id="troli">
                    <img class="w-16" src="<?= base_url('assets/'); ?>/img/troli.png" alt="">
                </div>
            </div>
       

            <input type="checkbox" id="toggle" class="hidden">
            <label for="toggle" style="display:none;">
                <div class="w-10 h-5  shadow-black dark:shadow-white shadow-lg rounded-full p-1 flex items-center cursor-pointer">
                    <div class="h-4 w-4 rounded-full flex  bg-black dark:bg-white toggle-circle"></div>
                </div>
            </label>
        </div>   
        <div id="navbar" class=" zal">
            <span class="slice "><a href="#Home"><img class="bayangan" src="<?= base_url('assets/'); ?>/img/home.png" alt="" width="18px"></a></span>
            <p class="ham"><a href="#Home">Home</a></p>
            <span class="slice"><a href="#product"><img class="bayangan" src="<?= base_url('assets/'); ?>/img/order.png" alt="" width="18px"></a></span>
            <p class="ham"><a href="#product">Product</a></p>
            <span class="slice"><a href="#about"><img class="bayangan" src="<?= base_url('assets/'); ?>/img/group.png" alt="" width="18px"></a></span>
            <p class="ham"><a href="#about">About Me</a></p>
            <span class="slice "><a href="#contact"><img class="bayangan" src="<?= base_url('assets/'); ?>/img/contact-us.png" alt="" width="18px"></a></span>
            <p class="ham"><a href="#contact">Contact</a></p>
        </div>
    </div>
    <!-- Batas Navbar -->
    <div id="Home" class="flex relative">
       
        <img id="mainImage" src="<?= base_url('assets/'); ?>/img/pertama.jpg" alt="" class="w-full h-auto ">
        <h1 id="parallaxContent" class="text-2xl font-bebas font-extrabold sm:text-[60px] sm:top-20 md:text-[70px] lg:text-8xl lg:top-36 md:top-32 absolute text-white top-10 left-1/2 transform -translate-x-1/2 transition-transform" style="text-shadow: 0 10px 20px rgb(0, 0, 0);">
            TRACKOUTDOOR
        </h1>
        
        <p id="motto" class="text-white font-semibold text-[10px] top-[55%] left-10 z-30 absolute sm:text-lg md:text-xl">welcome <br><span class="text-teal-500 font-bold">ようこそ</span> <br> Selamat Datang</p>    
        <img id="dua" src="<?= base_url('assets/'); ?>/img/dua.png" alt="" class="w-full h-auto top-0 absolute  z-20 bg-cover">
        <!-- MEDSOS -->
 
         
    </div> 
  <!-- Product -->
<div id="product" class="z-[99] h-full min-w-min bg-white relative py-16 dark:bg-malam dark:text-white" >

<img src="<?= base_url('assets/'); ?>/img/star.png" alt="" class="absolute animate-pulse top-0 left-0 hidden dark:block w-screen h-auto sm:h-60">

    <h1 class="text-center flex mx-auto top-12  justify-center text-cyan-400 font-bold sm:text-lg font-rubik" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="1000">OUR PRODUCTS</h1>

    <h1 class="text-center flex justify-center relative text-cyan-400 font-bold sm:text-lg font-bebas" data-aos="fade-zoom" >OUR PRODUCTS</h1>

    <h1 class="text-center flex  mx-auto top-20  justify-center text-cyan-400 font-bold sm:text-lg font-rubik" data-aos="fade-down" data-aos-duration="2000" data-aos-delay="1000">OUR PRODUCTS</h1>


 <div class="container mx-auto grid grid-cols-1  md:grid-cols-3 mt-5 gap-5" data-aos="zoom-in-up"  >
    <div class="bg-teal-500 p-5 rounded-md flex justify-between relative">
        <div class="font-light text-xl text-white"><p>Diskon 50 %</p>
        <p class="font-bold text-3xl text-white">Celana</p>
    <button type="button" class="bg-white border mt-3 hover:text-teal-500 text-black rounded-md font-medium hover:scale-105">
Beli Sekarang
    </button></div>
        <div class="absolute bottom-0 right-0"><img src="<?= base_url('assets/'); ?>/img/product/celana/Celana2-removebg-preview.png" alt="lampu" width="100px"></div>
    </div>


    <div class="bg-sky-500 p-5 rounded-md flex justify-between relative">
        <div class="font-light text-xl text-white"><p>Diskon 40%</p>
        <p class="font-bold text-3xl text-white">Tas Carrier</p>
    <button type="button" class="bg-white border mt-3 text-black hover:text-sky-600 rounded-md font-medium hover:scale-105">
Beli Sekarang
    </button></div>
        <div class="absolute bottom-0 right-0"><img src="<?= base_url('assets/'); ?>/img/product/tas/tas1.png" alt="lampu" width="100px"></div>
    </div>


    <div class="bg-oren p-5 rounded-md flex justify-between relative">
        <div class="font-light text-xl text-white"><p>Diskon 60%</p>
        <p class="font-bold text-3xl text-white">Tenda</p>
    <button type="button" class="bg-white border mt-3 text-black hover:text-oren rounded-md font-medium hover:scale-105">
Beli Sekarang
    </button></div>
        <div class="absolute bottom-0 right-0"><img src="<?= base_url('assets/'); ?>/img/product/tenda/tenda1.png" alt="lampu" width="100px"></div>
    </div>
  
 </div>
 <!-- PRODUCT -->
 <?php if($kategori) : ?>
    <?php foreach($kategori AS $row) : ?>
        <?php if(isset($result[$row->id_kategori])) : ?>
    <div class="container mx-auto mt-8 z-[999]">
        <h1 class="font-bold text-2xl" data-aos="fade-zoom" ><?= $row->nama; ?></h1>
        <div class="mt-4 grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 p-5" data-aos="fade-zoom" data>
        
        
            <?php foreach($result[$row->id_kategori] AS $key) : ?>
            <div class="top">
                <div class="  bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="bg-teal-500 flex justify-center">
                        <img src="<?= image_check($key['gambar'],'produk') ?>" alt="" width="150px">
                    </div>
                    <div class="px-5 pb-5">
                        <a href="#" alt="__blank">
                            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white"><?= $key['nama']; ?></h5>
                        </a>
                        <div class="flex items-center mt-2.5 mb-5">
                            <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                <?php for($i = 0;$i < $key['bintang'];$i++) { ?>
                                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                                <?php } ?>
                                
                                <?php for($i = 0;$i < (5 - $key['bintang']);$i++) { ?>
                                 <svg class="w-4 h-4 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                                <?php } ?>
                               
                                
                            </div>
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-3"><?= $key['bintang']; ?></span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-3xl font-bold text-gray-900 dark:text-white">$<?= number_format($key['harga'],2,",","."); ?></span>
                            <?php if(isset($_SESSION[PREFIX_SESSION.'_id_user'])) : ?>
                                <button data-id="<?= $key['id_produk'] ?>" class="add-to-cart-button text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add to cart</button>
                            <?php else : ?>
                                <button onclick="toggleLogin()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login Untuk Membeli</button>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        
        </div>

    </div>
     <?php endif;?>
    <?php endforeach;?>
 <?php endif;?>
 <!-- TUTUP PRODUCT -->

  <div id="about" class="z-[9999px] h-full min-w-min relative bg-white py-16  dark:bg-malam dark:text-white">
    <div class="malam hidden dark:block">
        <div class="bintang"></div>
        <div class="bintang"></div>
        <div class="bintang"></div>
        <div class="bintang"></div>
        <div class="bintang"></div>
      </div>
    <h1 class="text-center flex justify-center relative font-bold font-bebas sm:text-lg " data-aos="fade-zoom" data-aos-duration="2000" data-aos-delay="1000">ABOUT US</h1>
    <div class="flex flex-col relative sm:flex-row justify-between p-2 items-center " >
        <div class=" w-full sm:w-1/2 dark:bg-white dark:rounded-md " data-aos="fade-down" data-aos-delay="2000">
            <div class="h-5 w-5 bg-[#F9B22A] rounded-full left-10 flex absolute -mt-2 animate-bounce"></div>
            <img src="<?= base_url('assets/'); ?>/img/brands.png" alt="" class="w-full h-auto relative">
        </div>
        <div class="text-justify  text-sm p-2 w-full sm:w-1/2 overflow-auto" data-aos="fade-up" data-aos-delay="2000">
            <h1 class="font-thin "><span class="font-bold font-serif underline">Selamat datang di Trisula Outdoors!</span><br> Kami adalah penyedia peralatan pendakian terpercaya. Dengan komitmen pada kualitas, pengalaman terarah, dan komitmen lingkungan, kami menyediakan solusi lengkap untuk petualangan outdoor Anda. Temukan peralatan berkualitas tinggi, panduan ahli, dan komunitas petualang yang solid di Trisula Outdoors. Bersama-sama, mari jelajahi alam bebas dan ciptakan kenangan tak terlupakan!</h1>
        </div>
       
    </div>
    <!-- OUR TEAM -->
   
    <div class="justify-center flex py-10"><h1 class="font-bold text-xl text-teal-500 " data-aos="fade-zoom" data-aos-duration="1000" data-aos-delay="1000">Our <span class="font-rubik text-teal-500 text-2xl">Team</span></h1></div>
<div class="  grid grid-cols-2  sm:grid-cols-3  gap-5 ">
    
    <div id="animated-element" class="flex w-full h-48  justify-center   relative " data-aos="zoom-in-up"  data-aos-duration="2000">
        <div class=" justify-center  flex">
            <img class="absolute flex " src="<?= base_url('assets/'); ?>/img/boy1.png" alt="" class="Rizal " width="100px" >
              </div> 
        <p class="absolute bottom-3 font-bebas text-center font-semibold text-md text-purple-700">Tarma Suhendar</p>
        <p class="absolute text-[10px] bottom-0  font-bebas  text-purple-700">Design MockUp||Multimedia</p>
      
    </div>
    <!-- 2 -->
    <div id="animated-element" class="flex w-full h-48  justify-center   relative  " data-aos="zoom-in-up" data-aos-delay="1500"  data-aos-duration="2000">
        <div class="  justify-center  flex">
            <img class="absolute flex  " src="<?= base_url('assets/'); ?>/img/boy2.png" alt="" class="Rizal " width="100px" >
              </div> 
        <p class="absolute bottom-3 font-bebas text-lg text-center font-semibold  text-purple-500">Muhammad Rizal</p>
        <p class="absolute text-[10px] bottom-0 font-bebas  text-purple-500">Ui & Ux || Web Design</p>
      
    </div>
    <!-- 2 -->
    <div id="animated-element" class="flex w-full h-48  top-8 sm:bottom-10 justify-center   relative  " data-aos="zoom-in-up" data-aos-delay="1500"  data-aos-duration="2000">
        <div class="  justify-center  flex">
            <img class="absolute flex  " src="<?= base_url('assets/'); ?>/img/boy3.png" alt="" class="Rizal " width="100px" >
              </div> 
        <p class="absolute bottom-3 font-bebas font-semibold  text-purple-500">Dicky Agustian</p>
        <p class="absolute text-[10px] bottom-0 font-bebas  text-purple-500">Ui & Ux || Web Design</p>
      
    </div>
    
    <!-- 3 -->
    <div id="animated-element" class="flex w-full h-48 top-8 sm:top-0 justify-center   relative " data-aos="zoom-in-up" data-aos-delay="2000"  data-aos-duration="2000">
        <div class="  justify-center  flex">
       <img class="absolute flex  " src="<?= base_url('assets'); ?>/img/girl1.png" alt="" class="Rizal " width="90px" >
         </div> 
        <p class="absolute bottom-3 font-bebas font-semibold  text-pink-600">Yuliana</p>
        <p class="absolute text-[10px] bottom-0 font-bebas  text-pink-600">PowerPoint</p>
    </div>
    
    <!-- 4 -->
    <div id="animated-element" class="flex w-full h-48 top-8  sm:top-0  sm:col-start-2 justify-center   relative " data-aos="zoom-in-up" data-aos-delay="2500" data-aos-duration="2000">
        <div class="  justify-center  flex">
       <img class="absolute flex " src="<?= base_url('assets/'); ?>/img/girl2.png" alt="" class="Rizal " width="100px" >
         </div> 
        <p class="absolute bottom-3 font-bebas font-semibold  text-orange-300">Yafkha Kayla</p>
        <p class="absolute text-[10px] bottom-0 font-bebas  text-orange-300">PowerPoint</p>
    </div>
  
    
</div>
  </div>
  <div id="contact" class=" mx-auto p-8 dark:bg-malam">
    <h1 class="text-3xl font-semibold mb-6 text-center dark:text-white">Contact Us</h1>
  
    
    <form id="form_contact" method="POST" action="<?= base_url('user_function/contact'); ?>" class="bg-transparent shadow-teal-400 rounded-lg  shadow-md p-6">
        <div class="mb-4" id="req_contact_nama">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="contact_nama">Nama</label>
          <input class="border rounded-md py-2 px-3 w-full focus:outline-none focus:border-blue-400" type="text" id="contact_nama" name="nama" placeholder="Masukkan Nama.." required autocomplete="off">
        </div>
        <div class="mb-4" id="req_contact_email">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="contact_email">Email</label>
          <input class="border rounded-md py-2 px-3 w-full focus:outline-none focus:border-blue-400" type="email" id="contact_email" name="email" placeholder="Masukkan Email..." required autocomplete="off">
        </div>
        <div class="mb-4" id="req_contact_message">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="contact_message">Your Message</label>
          <textarea class="border rounded-md py-2 px-3 w-full h-32 resize-none focus:outline-none focus:border-blue-400" id="contact_message" name="message" placeholder="Masukkan Pesan..." required autocomplete="off"></textarea>
        </div>
        <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button" onclick="submit_form(this,'#form_contact',2)" id="btn_message">Send Message</button>
      </form>
    </div>


    
    <footer class="bg-gray-800 text-white py-6 translate-y-16">
        <div class="container mx-auto px-4">
    
            <!-- Judul Footer -->
            <div class="text-center font-bold text-lg font-rubik mb-4">
                FOOTER
            </div>
    
            <div class="grid gap-8 md:grid-cols-3 ">
    
                <!-- Lokasi -->
                <div class="text-center">
                    <h3 class="text-sm font-semibold mb-2">Location</h3>
                    <p>Jl. Sumur Kondang 56-58, Mekarjaya, Kec. Purwasari, Karawang, Jawa Barat 41373
                    </p>
                    <!-- Google Maps iframe -->
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.9844903143417!2d107.3878197698019!3d-6.395999848374135!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e697384411c85cd%3A0x46b26ddc4995fa96!2sJl.%20Sumur%20Kondang%2056-58%2C%20Mekarjaya%2C%20Kec.%20Purwasari%2C%20Karawang%2C%20Jawa%20Barat%2041373!5e0!3m2!1sid!2sid!4v1715486148990!5m2!1sid!2sid"
                        width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
    
                <!-- Media Sosial -->
                <div class="text-center md:row-start-2  md:col-start-2 py-3">
                    <h3 class="text-sm font-semibold mb-2">Follow Us</h3>
                    <div class="flex justify-center space-x-4">
                        <a href="https://www.facebook.com/your-profile" class="text-2xl hover:scale-110 hover:shadow-sky-600 hover:shadow-lg ">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.instagram.com/your-profile" class="text-2xl hover:scale-110 hover:shadow-sky-600 hover:shadow-lg">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.twitter.com/your-profile" class="text-2xl hover:scale-110 hover:shadow-sky-600 hover:shadow-lg">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
    
                <!-- Kotak Pencarian -->
                <div class="md:text-end text-center md:text-lg md:translate-y-1/2 md:col-start-3 mx-4 ">
                    <h3 class="text-sm font-semibold">Quick Links</h3>
                    <a href="#privacy" class="block hover:text-teal-400">Privacy Policy</a>
                    <a href="#terms" class="block hover:text-teal-400">Terms & Conditions</a>
                    <a href="#faq" class="block hover:text-teal-400">FAQ</a>
                </div>
    
                <!-- Hak Cipta -->
               
            </div>
        </div>
        <div class="text-center md:col-span-2 lg:col-span-1">
            <p class="border-t border-gray-700 pt-2">&copy; 2024 Trisula. All rights reserved.</p>
        </div>
    </footer>
    
    
    

   
  
</body>
<script src="<?= base_url('assets') ?>/js/jquery.js"></script>
<script src="<?= base_url('assets') ?>/js/change.js"></script>
<script src="<?= base_url('assets') ?>/js/function.js"></script>
<script src="<?= base_url('assets') ?>/js/script.js"></script>
<script src="<?= base_url('assets') ?>/js/start.js"></script>
<script src="<?= base_url('assets') ?>/alert/sweetalert2.js"></script>
<script src="<?= base_url('assets') ?>/alert/scriptalert.js"></script>
<script src="<?= base_url('assets') ?>/js/sendToWhatsapp.js"></script>
<script src="<?= base_url('assets') ?>/node_modules/aos/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script>
    var BASE_URL = '<?= base_url(); ?>';
    var css_btn_confirm = 'btn btn-primary';
    var css_btn_cancel = 'btn btn-danger';
</script>
<script>
    let cart = [];
    let subtotal = 0;

    function toggleCart() {
        const slide = document.getElementById('slide');
        slide.classList.toggle('hidden');
    }

    function toggleLogin() {
        const slide = document.getElementById('slide_login');
        slide.classList.toggle('hidden');
    }

    function auth_tipe(tipe = 'register') {
        if (tipe == 'register') {
            $('#form_login').removeClass('showin');
            $('#form_login').addClass('hidin');
        }else{
            $('#form_register').removeClass('showin');
            $('#form_register').addClass('hidin');
        }
        $('#form_'+tipe).removeClass('hidin');
        $('#form_'+tipe).addClass('showin');
        
    }

    document.querySelectorAll('.add-to-cart-button').forEach(button => {
        button.addEventListener('click', function() {
            const id = $(button).data('id')
            var id_cart = 0;
            // console.log(id);
            const productCard = button.closest('.top'); // Sesuaikan dengan struktur HTML produk Anda
            const productTitle = productCard.querySelector('h5').innerText;
            const productImage = productCard.querySelector('img').src;
            const productPrice = parseFloat(productCard.querySelector('.text-3xl').innerText.replace('$', ''));
            const slide = document.getElementById('slide');

            $.ajax({
                url: BASE_URL + 'user_function/add_cart',
                method: 'POST',
                data: { id: id},
                dataType: 'json',
                success: function (idd) {
                    // id_cart = idd;
                    // console.log(idd);
                    // Buat elemen HTML untuk produk yang ditambahkan ke keranjang
                    const productHTML = `
                        <li class="py-6 flex">
                            <img src="`+productImage+`" alt="" class="h-10 w-10 rounded-full flex-shrink-0 object-cover" />
                            <div class="ml-4 flex-1 flex flex-col">
                                <div>
                                    <div class="flex justify-between text-base font-medium text-gray-900">
                                        <h3>${productTitle}</h3>
                                        <p class="ml-4">$${productPrice.toFixed(2)}</p>
                                    </div>
                                    <p class="mt-1 text-sm text-gray-500">Quantity: 1</p>
                                </div>
                                <button class="text-red-500 hover:text-red-700 mt-2 self-end" onclick="removeFromCart(this, ${productPrice},`+idd+`)">Remove</button>
                            </div>
                        </li>
                    `;

                    // Masukkan produk ke dalam daftar belanja
                    const cartItems = document.getElementById('cart-items');
                    cartItems.innerHTML += productHTML;

                    // Hitung ulang subtotal
                    updateSubtotal(productPrice);

                    // Tampilkan keranjang belanja
                    slide.classList.remove('hidden');
                }
            })
            
            

            
        });
    });

    // Fungsi untuk menyembunyikan/menampilkan keranjang belanja
    // Fungsi untuk mengupdate subtotal
    function updateSubtotal(price) {
        const subtotalElement = document.getElementById('cart-subtotal');
        var total = $('#real_total').val();
        total = Number(total);
        // Tambahkan harga produk baru ke subtotal
        
        total += Number(price);
        console.log(total);
        
        if (total > 0) {
            $('#btn_checkout').prop('disabled', false);
        }else{
            $('#btn_checkout').prop('disabled', true);
        }
        subtotalElement.textContent = `$`+total.toFixed(2);
        $('#real_total').val(total);
    }

    // Fungsi untuk menghapus item dari keranjang
    function removeFromCart(button, price, id) {
        // Hapus elemen produk dari DOM
        const productItem = button.closest('li');
        productItem.remove();

        // Kurangi harga produk dari subtotal
        updateSubtotal(-price);

        $.ajax({
            url: BASE_URL + 'user_function/remove_cart',
            method: 'POST',
            data: { id: id},
            cache: false,
            dataType: 'json',
            success: function (data) {
                console.log('Produk di hapus!');
            }
        })
    }


</script>
</html>