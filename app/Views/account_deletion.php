
  <style>
    .account-section{
        /* padding-top: 50px; */
        width: 100%;
        min-height: 500px;
        /* color: white; */
        /* background-color: DodgerBlue; */
        /* text-align: center; */
    }
    /* body { font-family: Arial, sans-serif; background: #f9f9f9; color: #333; padding: 20px; } */
    /* .container { max-width: 700px; margin: auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); } */
    h1 { color: #c0392b; }
    label { display: block; margin-top: 20px; font-weight: bold; }
    input, textarea { width: 100%; padding: 10px; margin-top: 8px; border: 1px solid #ccc; border-radius: 5px; }
    button { margin-top: 20px; padding: 10px 20px; background: #c0392b; color: #fff; border: none; border-radius: 5px; cursor: pointer; }
    button:hover { background: #a93226; }
    .note { margin-top: 30px; font-size: 0.95em; color: #555; line-height: 1.6; }
  </style>

  <div class="account-section">
    <div class="banner-stripe">
        <h2 class="text-center">Request Account Deletion</h2>
    </div>
    <div class="container">
      <!-- <h1>Request Account Deletion</h1> -->
      <p>If you would like to request the deletion of your Career Boss account, please fill out the form below. We take your privacy seriously and are committed to handling your request with care and security.</p>

      <form action="<?=current_url()?>" method="post" >
        <?=csrf_field();?>
        <label for="name">Your Full Name</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Your Registered Email</label>
        <input type="email" id="email" name="email" required>

        <label for="reason">Reason for Account Deletion (optional)</label>
        <textarea id="reason" name="reason" rows="4"></textarea>

        <button type="submit">Submit Deletion Request</button>
      </form>

      <div class="note">
        <h2>Important Information</h2>
        <p>
          When you request to delete your Career Boss account:
          <ul>
            <li>Your login access will be permanently disabled</li>
            <li>Your profile photo and user preferences will be removed</li>
            <li>You will no longer receive notifications, marketing emails or app alerts</li>
          </ul>
          <strong>However:</strong>
          <ul>
            <li>We are required to retain certain student records for certification verification, academic history, and institutional compliance</li>
            <li>This includes your course enrollment, fee payment history, and student ID</li>
            <li>This data is securely stored and <strong>never shared or sold</strong> to any third party</li>
          </ul>
          
          <p>Your privacy and data security is our top priority. You can view our full privacy policy <a href="<?=base_url('privacy-policy')?>" >here</a>.</p>
        </p>
      </div>
    </div>
  </div>

