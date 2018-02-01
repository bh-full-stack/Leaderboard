import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { ChangeDetectorRef } from '@angular/core';

import { Player } from '../../models/player';
import { PlayerService } from '../../services/player.service';
import { AuthService } from '../../../shared/services/auth.service';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css']
})
export class ProfileComponent implements OnInit {

  public player: Player;
  public errors: {[field: string]: string[]} = {};
  public message: string;
  public form = new FormGroup(
    {
      password: new FormControl('', [Validators.required, Validators.minLength(6)]),
    },
  );
 
  constructor(
    private _playerService: PlayerService,
    private _authService: AuthService,
    private _ref: ChangeDetectorRef
  ) { }

  ngOnInit() {
    this.player = this._authService.player;
  }

  public handleOldScores(action: string) {
    this._playerService.handleOldScores(this.player.password, action).subscribe(
      response => { 
        this._authService.setPlayer(response['player']);
        this.message = response['message'];
        this.player = this._authService.player;
      },
      errorResponse => {
        this.errors = errorResponse.error.errors;
      }
    );
  }

}
