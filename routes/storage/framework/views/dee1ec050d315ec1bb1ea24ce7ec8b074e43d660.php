<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="shortcut icon" href="<?php echo e(asset('asset/client/images/favicon.png')); ?>">
      <title><?php echo e(setting_website()->name); ?></title>
      <link href="<?php echo e(asset('asset/client/css/bootstrap.css')); ?>" rel="stylesheet">
      <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,700,500italic,100italic,100' rel='stylesheet' type='text/css'>
      <link href="<?php echo e(asset('asset/client/css/font-awesome.min.css')); ?>" rel="stylesheet">
      <link rel="stylesheet" href="<?php echo e(asset('asset/client/css/flexslider.css')); ?>" type="text/css" media="screen"/>
      <link href="<?php echo e(asset('asset/client/css/sequence-looptheme.css')); ?>" rel="stylesheet" media="all"/>
      <link href="<?php echo e(asset('asset/client/css/style.css')); ?>" rel="stylesheet">
      <link rel="stylesheet" href="<?php echo e(asset('asset/admin/plugins/fontawesome-free/css/all.min.css')); ?>">
      <?php echo app('Illuminate\Foundation\Vite')(['resources/client/css/auth.css', 'resources/client/css/home.css']); ?>
      <!--[if lt IE 9]><script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script><script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script><![endif]-->
   </head>
   <style>
      .thumbnail{ margin: unset; height: 260px; }
      .thumbnail img{ height: 100% !important; width: 100% !important; object-fit: cover; }
      .productname{ padding-top: 10px; }

      /* CSS CHO CHATBOT AI */
      .bot-message img {
          max-width: 100% !important;
          height: auto !important;
          border-radius: 8px;
          margin: 10px 0;
          display: block;
          box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      }
      .bot-message p { margin-bottom: 5px; }
      .bot-message strong { color: #0d6efd; }
  </style>
   <body id="home">
      <div class="wrapper">
         <div class="header">
            <div class="container">
               <div class="row">
                  <div class="col-md-2 col-sm-2">
                     <div class="logo">
                        <a href="<?php echo e(route('user.home')); ?>">
                           <img src="<?php echo e(asset("asset/client/images/" . setting_website()->logo)); ?>" alt="FlatShop">
                        </a>
                     </div>
                  </div>
                  <div class="col-md-10 col-sm-10">
                     <div class="header_top">
                        <div class="row">
                           <div class="col-md-6">
                              <ul class="topmenu">
                                 <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                 <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                                 <li><a href="#"><i class="fab fa-instagram-square"></i></a></li>
                                 <li><a href="#"><i class="fab fa-telegram-plane"></i></a></li>
                                 <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                              </ul>
                           </div>
                           <div class="col-md-6">
                              <?php if(Auth::check()): ?>
                              <ul class="nav navbar-nav usermenu">
                                 <li class="dropdown">
                                    <a href="#" class="dropdown-toggle profile" data-toggle="dropdown">
                                       <img src="<?php echo e(asset('asset/client/images/loginbg.png')); ?>" alt="">
                                       <span><?php echo e(Auth::user()->name); ?></span>
                                    </a>
                                    <div class="dropdown-menu">
                                       <ul class="mega-menu-links">
                                          <li><a href="<?php echo e(route('profile.index')); ?>">Thông tin cá nhân</a></li>
                                          <li><a href="<?php echo e(route('order_history.index')); ?>">Lịch sử mua hàng</a></li>
                                          <li><a href="<?php echo e(route('user.logout')); ?>">Đăng xuất</a></li>
                                       </ul>
                                    </div>
                                 </li>
                              </ul>
                              <?php else: ?>
                              <ul class="usermenu">
                                 <li><a href="<?php echo e(route('user.login')); ?>" class="log">Đăng Nhập</a></li>
                                 <li><a href="<?php echo e(route('user.register')); ?>" class="reg">Đăng Kí</a></li>
                              </ul>
                              <?php endif; ?>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <div class="header_bottom">
                        <ul class="option">
                           <li id="search" class="search">
                              <form method="GET" action="<?php echo e(route('user.search')); ?>">
                                 <input class="search-submit" type="submit" value="">
                                 <input class="search-input" placeholder="Enter your search term..." type="text" value="" name="keyword">
                              </form>
                           </li>
                           <li class="option-cart">
                              <a href="<?php echo e(route('cart.index')); ?>" class="cart-icon">cart <span class="cart_no"></span></a>
                           </li>
                        </ul>
                        <div class="navbar-header"><button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button></div>
                        <div class="navbar-collapse collapse">
                           <ul class="nav navbar-nav">
                              <li class="dropdown <?php echo e((request()->is('/*')) ? 'active' : ''); ?>">
                                 <a href="<?php echo e(route('user.home')); ?>">Trang Chủ</a>
                              </li>
                              <?php $__currentLoopData = category_header(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <li class="dropdown <?php
                                    if (isset($request->slug) && $request->slug == $category->slug) {
                                       echo "active";
                                    }
                                 ?>">
                                    <a href="<?php echo e(route('user.products', $category->slug)); ?>"><?php echo e($category->name); ?></a>
                                 </li>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <li class="dropdown <?php echo e((request()->is('introduction*')) ? 'active' : ''); ?>">
                                 <a href="<?php echo e(route('user.introduction')); ?>">Giới Thiệu</a>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <?php echo $__env->yieldContent('content-client'); ?>
         <div class="clearfix"></div>
         <div class="footer">
            <div class="footer-info">
               <div class="container">
                  <div class="row">
                     <div class="col-md-3">
                        <div class="footer-logo">
                           <a href="<?php echo e(route('user.home')); ?>">
                              <img src="<?php echo e(asset("asset/client/images/" . setting_website()->logo)); ?>" alt="">
                           </a>
                        </div>
                     </div>
                     <div class="col-md-3 col-sm-6">
                        <h4 class="title">Thông tin liên hệ</h4>
                        <p><?php echo e(setting_website()->address); ?></p>
                        <p>Số điện thoại : <?php echo e(setting_website()->phone_number); ?></p>
                        <p>Email : <?php echo e(setting_website()->email); ?></p>
                     </div>
                     <div class="col-md-3 col-sm-6">
                        <h4 class="title">Về chúng tôi</h4>
                        <p>Chuyên bán thời trang an toàn. Tin cậy nhanh chóng. Chăm sóc khách hàng 24/24</p>
                     </div>
                     <div class="col-md-3">
                        <h4 class="title">Nhận thông tin từ chúng tôi</h4>
                        <p>Cảm ơn rất nhiều</p>
                        <form class="newsletter">
                           <input type="text" name="" placeholder="Email của bạn">
                           <input type="submit" value="Gửi" class="button">
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php if(Session::has('success')): ?>
        <span id="toast__js" message="<?php echo e(session('success')); ?>" type="success"></span>
      <?php elseif(Session::has('error')): ?>
         <span id="toast__js" message="<?php echo e(session('error')); ?>" type="error"></span>
      <?php endif; ?>
      
      <script src="<?php echo e(asset('asset/admin/plugins/jquery/jquery.min.js')); ?>"></script>
      <script src="<?php echo e(asset('asset/admin/plugins/jquery-validation/jquery.validate.js')); ?>"></script>
      <script type="text/javascript" src="<?php echo e(asset('asset/client/js/jquery-1.10.2.min.js')); ?>"></script>
      <script type="text/javascript" src="<?php echo e(asset('asset/client/js/jquery.easing.1.3.js')); ?>"></script>
      <script type="text/javascript" src="<?php echo e(asset('asset/client/js/bootstrap.min.js')); ?>"></script>
      <script type="text/javascript" src="<?php echo e(asset('asset/client/js/jquery.sequence-min.js')); ?>"></script>
      <script type="text/javascript" src="<?php echo e(asset('asset/client/js/jquery.carouFredSel-6.2.1-packed.js')); ?>"></script>
      <script type="text/javascript" src="<?php echo e(asset('asset/client/js/script.min.js')); ?>" ></script>
      <script defer src="<?php echo e(asset('asset/client/js/jquery.flexslider.js')); ?>"></script>
      <?php echo app('Illuminate\Foundation\Vite')(['resources/admin/js/toast-message.js']); ?>

      <!-- ================================================== -->
      <!-- CHATBOX AI -->
      <!-- ================================================== -->
      <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

      <!-- Nút bấm Chatbox (Icon Robot SVG) -->
      <div id="chat-button" style="position: fixed; bottom: 20px; right: 20px; background: #fff; border: 2px solid #0d6efd; border-radius: 50%; width: 65px; height: 65px; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 4px 12px rgba(0,0,0,0.2); z-index: 9999; overflow: hidden;">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#0d6efd" style="width: 40px; height: 40px;">
              <path d="M12 2a2 2 0 0 1 2 2c0 .74-.4 1.39-1 1.73V7h1a4 4 0 0 1 4 4v1h1a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-1v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2v-1H5a2 2 0 0 1-2-2v-4a2 2 0 0 1 2-2h1v-1a4 4 0 0 1 4-4h1V5.73A2 2 0 0 1 10 4a2 2 0 0 1 2-2zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-3 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm6 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
          </svg>
      </div>

      <div id="chat-window" style="display: none; position: fixed; bottom: 90px; right: 20px; width: 350px; height: 450px; background: white; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 9999; flex-direction: column; overflow: hidden; border: 1px solid #ddd;">
          <div style="background: #0d6efd; color: white; padding: 15px; font-weight: bold; display: flex; justify-content: space-between; align-items: center;">
              <span>🤖 Trợ lý ảo FlatShop</span>
              <span id="close-chat" style="cursor: pointer; font-size: 24px; line-height: 1;">&times;</span>
          </div>
          <div id="chat-messages" style="flex: 1; padding: 15px; overflow-y: auto; background: #f8f9fa; font-size: 14px;">
              <div style="background: #e9ecef; padding: 10px; border-radius: 10px; margin-bottom: 10px; width: fit-content; max-width: 80%;">
                  Chào bạn! Mình là trợ lý ảo của FlatShop. Mình có thể giúp gì cho bạn hôm nay?
              </div>
          </div>
          <div style="padding: 10px; border-top: 1px solid #ddd; background: white; display: flex;">
              <input type="text" id="chat-input" placeholder="Nhập tin nhắn..." style="flex: 1; border: 1px solid #ddd; border-radius: 20px; padding: 8px 15px; outline: none; font-size: 14px;">
              <button id="send-chat" style="background: #0d6efd; color: white; border: none; border-radius: 50%; width: 40px; height: 40px; margin-left: 10px; cursor: pointer; font-size: 14px;">Gửi</button>
          </div>
      </div>

      <script>
          document.addEventListener('DOMContentLoaded', function() {
              const chatButton = document.getElementById('chat-button');
              const chatWindow = document.getElementById('chat-window');
              const closeChat = document.getElementById('close-chat');
              const sendChat = document.getElementById('send-chat');
              const chatInput = document.getElementById('chat-input');
              const chatMessages = document.getElementById('chat-messages');

              // Cấu hình Markdown
              marked.setOptions({ breaks: true, gfm: true });

              // Mở/đóng chat
              chatButton.addEventListener('click', () => {
                  if (chatWindow.style.display === 'none' || chatWindow.style.display === '') {
                      chatWindow.style.display = 'flex';
                  } else {
                      chatWindow.style.display = 'none';
                  }
              });
              
              closeChat.addEventListener('click', () => {
                  chatWindow.style.display = 'none';
              });

              // Hàm gửi tin nhắn
              async function sendMessage() {
                  const message = chatInput.value.trim();
                  if (!message) return;

                  chatMessages.innerHTML += `<div style="background: #0d6efd; color: white; padding: 10px; border-radius: 10px; margin-bottom: 10px; width: fit-content; max-width: 80%; margin-left: auto; word-wrap: break-word;">${message}</div>`;
                  chatInput.value = '';
                  chatMessages.scrollTop = chatMessages.scrollHeight;

                  const loadingId = 'loading-' + Date.now();
                  chatMessages.innerHTML += `<div id="${loadingId}" style="background: #e9ecef; padding: 10px; border-radius: 10px; margin-bottom: 10px; width: fit-content; max-width: 80%;">Đang trả lời...</div>`;
                  chatMessages.scrollTop = chatMessages.scrollHeight;

                  try {
                      const controller = new AbortController();
                      const timeoutId = setTimeout(() => controller.abort(), 45000); // Chờ tối đa 45s

                      const response = await fetch('/api/chat', {
                          method: 'POST',
                          headers: {
                              'Content-Type': 'application/json',
                              'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                          },
                          body: JSON.stringify({ message: message }),
                          signal: controller.signal 
                      });
                      
                      clearTimeout(timeoutId); 
                      
                      const data = await response.json();
                      
                      document.getElementById(loadingId).remove();

                      // Chuyển đổi Markdown (in đậm, link, ảnh) sang HTML
                      let replyHtml = marked.parse(data.reply);
                      replyHtml = replyHtml.replace(/<a /g, '<a target="_blank" ');
                      
                      chatMessages.innerHTML += `<div class="bot-message" style="background: #e9ecef; padding: 10px 15px; border-radius: 10px; margin-bottom: 10px; width: fit-content; max-width: 85%; word-wrap: break-word; line-height: 1.5;">${replyHtml}</div>`;
                  } catch (error) {
                      document.getElementById(loadingId).remove();
                      chatMessages.innerHTML += `<div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 10px; margin-bottom: 10px; width: fit-content; max-width: 85%;">Kết nối bị gián đoạn. Vui lòng thử lại!</div>`;
                  }
                  chatMessages.scrollTop = chatMessages.scrollHeight;
              }

              // Gửi khi bấm nút hoặc ấn Enter
              sendChat.addEventListener('click', sendMessage);
              chatInput.addEventListener('keypress', function (e) {
                  if (e.key === 'Enter') sendMessage();
              });
          });
      </script>
   </body>
</html><?php /**PATH C:\xampp\htdocs\Project\resources\views/layouts/client.blade.php ENDPATH**/ ?>