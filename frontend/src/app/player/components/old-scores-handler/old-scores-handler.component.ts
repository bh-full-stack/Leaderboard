import { Component, OnInit, Input, EventEmitter, Output } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';

import { PlayerService } from '../../services/player.service';
import { AuthService } from '../../../api/services/auth.service';
import { Player } from '../../models/player';

@Component({
  selector: 'app-old-scores-handler',
  templateUrl: './old-scores-handler.component.html',
  styleUrls: ['./old-scores-handler.component.css']
})
export class OldScoresHandlerComponent implements OnInit {

  @Input() public player: Player;
  public message: string;
  public errors: {[field: string]: string[]} = {};
  public form = new FormGroup({
    password: new FormControl('', [Validators.required, Validators.minLength(6)])
  });

  public constructor(
    private _playerService: PlayerService
  ) { 
    //
  }

  public ngOnInit() {
    //
  }

  public handleOldScores(action: string) {
    this._playerService.handleOldScores(this.player.password, action).subscribe(
      response => { 
        this.player = response['player'];
        this.message = response['message'];
      },
      errorResponse => {
        this.errors = errorResponse.error.errors;
      }
    );
  }

}
