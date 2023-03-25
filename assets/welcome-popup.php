<?php
session_start();

if (!isset($_SESSION['welcome-message'])) {
    $title = 'Welcome!';
    $message = 'This dashboard is developed for support purposes, works with KeyAuth authenticator.';
    $button1_text = 'Close';
    $button2_text = 'KeyAuth';
    $button2_link = 'https://keyauth.cc/';
    
    echo '<div class="popup">
          <div>
            <img draggable="false" src="https://cdn.keyauth.cc/front/assets/img/favicon.png" alt="Login" class="hangar-logo">
          </div>
          </br>
            <h2 style="color: #0d0d0d">'.$title.'</h2>
          <div class="text">
            <div class="info" style="color: #0d0d0d; text-align:center;">
              '.$message.'
            </div>
          </div>
          <div class="buttons">
            <button class="button" onclick="hidePopup()">'.$button1_text.'</button>
            <button class="button2" onclick="window.open(\''.$button2_link.'\', \'_blank\')">'.$button2_text.'</button>
          </div>
        </div>';

    $_SESSION['welcome-message'] = true;
}
?>

<script>
function hidePopup() {
  document.querySelector('.popup').style.display = 'none';
}
</script>

<style>
.hangar-logo {
    height: 100px;
    -webkit-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

.buttons {
  display: flex;
  margin-top: 8px;
  width: 100%;
}
.button {
  align-items: center;
  background: #8950fc;
  border-radius: 10px;
  cursor: pointer;
  display: flex;
  height: 50px;
  justify-content: center;
  margin: 0 5px 0px 5px;
  width: 100%;
}

.button:hover {
  background-color: #7337ee!important;
}


.button2 {
  align-items: center;
  background: #3699ff;
  border-radius: 10px;
  cursor: pointer;
  display: flex;
  height: 50px;
  justify-content: center;
  margin: 0 5px 0px 20px;
  width: 100%;
}

.button2:hover {
  background-color: #187de4!important;
}


.button:last-child {
  margin: 0 20px 20px 5px;
}

.button-primary {
  background-color: #0060f6;
  color: #fff;
}

.popup {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border: 1px solid #dee2e6;
    padding: 20px;
    text-align: center;
    align-items: center;
    background-color: #dee2e6;
    border-radius: 20px;
    box-shadow: 0 0.4px 3.6px rgba(0, 0, 0, 0.004), 0 1px 8.5px rgba(0, 0, 0, 0.01), 0 1.9px 15.7px rgba(0, 0, 0, 0.019), 0 3.4px 28.2px rgba(0, 0, 0, 0.03), 0 6.3px 54.4px rgba(0, 0, 0, 0.047), 0 15px 137px rgba(0, 0, 0, 0.07);
    display: flex;
    flex-direction: column;
    width: 336px;
}

.popup h2 {
  margin-top: 0;
}

.popup button {
    border: none;
    color: #fff;
    padding: 10px 20px;
    font-size: 16px;
    margin-top: 20px;
    align-items: center;
    border-radius: 10px;
    cursor: pointer;
    display: flex;
    height: 50px;
    justify-content: center;
    /* width: 100%; */
}
</style>
