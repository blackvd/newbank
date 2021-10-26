<div class="modal fade login-modal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" id="loginModalLabel">
          <h4 class="modal-title">Ajoutez un agent</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
        </div>
        <div class="modal-body">
          <form class="mt-0" id="FormAgent">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control mb-2" name="username" id="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control mb-2" id="name" placeholder="Nom" required>
            </div>
            <div class="form-group">
                <label for="pswd">Mot de passe</label>
                <input type="password" class="form-control mb-4" id="pswd" name="pswd" placeholder="Password" required minlength="6">
            </div>
            <div class="form-group">
                <label for="confirmation">Confirmez le mot de passe</label>
                <input type="password" class="form-control mb-4" id="confirmation" name="pswd_confirmation" minlength="6" required placeholder="Password">
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="role" class="custom-select mb-4">
                    <option selected>Roles</option>
                    <option value="1">admin</option>
                    <option value="2">agent depot</option>
                </select>
            </div>
        </form>
        <button id="btnFormAgent" class="btn btn-primary">Enregistrez</button>
        </div>
      </div>
    </div>
  </div>