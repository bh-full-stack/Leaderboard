import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';

import { Player } from '../../models/player';
import { AuthService } from '../../../api/services/auth.service';
import { PlayerService } from '../../services/player.service';

@Component({
  selector: 'app-player-delete',
  templateUrl: './player-delete.component.html',
  styleUrls: ['./player-delete.component.css']
})
export class PlayerDeleteComponent implements OnInit {

  public player: Player;
  public message: string;
  public errors: { [field: string]: string[] } = {};
  public form = new FormGroup(
    {
      password: new FormControl('', [Validators.required, Validators.minLength(6)]),
    },
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

  public deletePlayer() {
    this._playerService.deletePlayer(this.player).subscribe(
      response => {
        this.message = response['message'];
        this._authService.logout();
      },
      errorResponse => this.errors = errorResponse.error.errors
    );
  }

}
