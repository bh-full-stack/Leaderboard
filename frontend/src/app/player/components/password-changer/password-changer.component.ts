import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';

import { Player } from '../../models/player';
import { AuthService } from '../../../api/services/auth.service';
import { PlayerService } from '../../services/player.service';

@Component({
  selector: 'app-password-changer',
  templateUrl: './password-changer.component.html',
  styleUrls: ['./password-changer.component.css']
})
export class PasswordChangerComponent implements OnInit {

  public player: Player;
  public isSuccessful: boolean;
  public message: string;
  public errors: {[field: string]: string[]} = {};
  public form = new FormGroup(
    {
      currentPassword: new FormControl('', [Validators.required, Validators.minLength(6)]),
      password: new FormControl('', [Validators.required, Validators.minLength(6)]),
      passwordConfirm: new FormControl('', [Validators.required, Validators.minLength(6)]),
    },
    PasswordChangerComponent.passwordMatchValidator
  );

  public constructor(
    private _authService: AuthService,
    private _playerService: PlayerService
  ) {
    //
   }

  public ngOnInit() {
    this.player = this._authService.player;
  }

  public changePassword() {
    this._playerService.changePassword(this.player, this.form.controls.currentPassword.value)
      .subscribe(
        player => {
          this.message = "Your password has been changed.";
          this.isSuccessful = true;
        },
        errorResponse => {
          this.errors = errorResponse.error.errors;
          console.log(this.errors);
        }        
      )
  }

  public static passwordMatchValidator(g: FormGroup) {
    return g.get('password').value === g.get('passwordConfirm').value ? null : { 'mismatch': true };
  }

}
