
<div id="auth_form">
    <div class="form">
    <div class="tab-header">
    <div id="reg_form_btn">Registracija</div>
    <div id="login_form_btn">Prijava</div>
  </div>
  <div class="tab-content">
    <div class="tab-body active" id="reg_form">
    <div class="form-title">
        Registrirajte se
    </div>
      <div class="form-element">
        <input type="text" name="email" placeholder="Email" id="email" required>
      </div>
      <div class="form-element">
        <input type="text" name="username" placeholder="Korisničko ime" id="username2" required>
      </div>
      <div class="form-element">
        <input type="password" name="password" placeholder="Lozinka" id="password2" required>
      </div>
      <div class="form-element">
        <button id="registerbutton" name="registerbutton">Registrirajte se</button>
      </div>
        <div class="error" id="message1"></div>
    </div>
    
    <div class="tab-body " id="login_form">
    <div class="form-title">
        Prijavite se
    </div>
      <div class="form-element">
        <input type="text" name="username" id="username1" placeholder="Email ili korisničko ime">
      </div>
      <div class="form-element">
        <input type="password" name="password" id="password1" placeholder="Lozinka">
      </div>
      <div class="form-element">
        <button id="loginbutton" name="loginbutton">Prijavite se</button>
      </div>
      <div id="message"></div>
    </div>
  </div>
</div>
</div>
<div class="blocker" onclick="hidepopup()" id="blocker" style="visibility:hidden;"></div>



<div id="new_topic_modal">
<form method="POST" action="" class="form">
  <div class="form-content">
  <div class="form-title">
    Započnite novu temu
  </div>
  <div class="form-element">
    <select id="new_category_select" class="active-shadow">
    <option selected disabled>Odaberite kategoriju</option>
    <?php
     $categories= getCategories();
    while($row = mysqli_fetch_assoc($categories)) {
      ?>
      <option value="<?php echo $row['category_id']?>"><?php echo $row['category_name']?></option>
      <?php
    }
    ?>
    </select>
  </div>
  <div class="form-element">
    <input class="active-shadow" type="text" placeholder="Naslov teme" id="new_title" name="title">
  </div>
  <div class="form-element">
    <textarea class="new_content active-shadow" rows="4" placeholder="Opis teme" id="new_content" name="new_content" ></textarea>

  </div>
  <div class="form-element">
    <button id="new_topic_btn">Započni</button>
  </div>
</div>
</form>

</div>