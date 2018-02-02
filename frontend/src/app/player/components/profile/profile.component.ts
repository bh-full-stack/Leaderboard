import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { ChangeDetectorRef } from '@angular/core';

import { Player } from '../../models/player';
import { PlayerService } from '../../services/player.service';
import { AuthService } from '../../../shared/services/auth.service';
import { ActivatedRoute } from '@angular/router';

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
    public _authService: AuthService,
    private _ref: ChangeDetectorRef,
    private _activatedRoute: ActivatedRoute, 
  ) { }

  ngOnInit() {
    //this.player = this._authService.player;
    this._activatedRoute.params.subscribe(
      params => {
        this.player = this._playerService.showProfile(params.player_id);
        console.log(this._authService.player);
        console.log(this.player);
      }
    )
  }

  public isAuthenticatedPlayer() {
    return this.player.id == this._authService.player.id
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
