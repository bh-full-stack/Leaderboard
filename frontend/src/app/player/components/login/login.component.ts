import { Component, OnInit } from '@angular/core';
import { Player } from '../../models/player';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { AuthService } from '../../../shared/services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  public player: Player = new Player();
  public form = new FormGroup(
    {
      email: new FormControl('', [Validators.required, Validators.email]),
      password: new FormControl('', [Validators.required])
    }
  );

  constructor(private _authService: AuthService, private _router: Router) { }

  ngOnInit() {
  }


  public login() {
    this._authService.login(this.player).subscribe(
      (response: Response) => {
        this.player = new Player();
        this.form.reset();
        this._router.navigate(['/player/profile/' + response['player'].id]);
      },
      (error: any) => {
        console.log(error);
        window.alert('Login failed.');
      },
      () => {
        //
      }
    );
  }

}
