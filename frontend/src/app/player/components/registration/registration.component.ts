import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { Player } from '../../models/player';
import { ApiService } from '../../../shared/services/api.service';
import { PlayerService } from '../../services/player.service';

@Component({
  selector: 'app-registration',
  templateUrl: './registration.component.html',
  styleUrls: ['./registration.component.css']
})
export class RegistrationComponent implements OnInit {

  public player: Player = new Player;
  public introduction: string;
  public isRegistrationDone: boolean = false; 
  public errors: {[field: string]: string[]} = {};
  public form = new FormGroup(
    {
      name: new FormControl('', Validators.required),
      email: new FormControl('', [Validators.required, Validators.email]),
      password: new FormControl('', [Validators.required, Validators.minLength(6)]),
      passwordConfirm: new FormControl('', [Validators.required, Validators.minLength(6)]),
      introduction: new FormControl('')
    },
    RegistrationComponent.passwordMatchValidator
  );

  public static passwordMatchValidator(g: FormGroup) {
    return g.get('password').value === g.get('passwordConfirm').value ? null : { 'mismatch': true };
  }   

  public setIntroduction(text) {
    this.introduction = text;
  }

  public constructor(private _playerService: PlayerService) { }

  public ngOnInit() {
    //
  }

  public register() {
    this._playerService.register(this.player).subscribe(
      response => { 
        this.isRegistrationDone = true;
        console.log(response); 
      },
      errorResponse => { 
        this.errors = errorResponse.error.errors;
      }
    );
  }

}
