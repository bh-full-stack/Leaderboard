import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { PlayerService } from '../../services/player.service';
import { Player } from '../../models/player';

@Component({
  selector: 'app-activation',
  templateUrl: './activation.component.html',
  styleUrls: ['./activation.component.css']
})
export class ActivationComponent implements OnInit {

  public errorMessage: string;
  public player: Player;

  constructor(
    private _activatedRoute: ActivatedRoute, 
    private _playerService: PlayerService
  ) { }

  ngOnInit() {
    this._activatedRoute.params.subscribe(
      params => this._playerService.activate(params.activation_code).subscribe(
        player => this.player = player,
        errorResponse => this.errorMessage = errorResponse.error.message
      )
    );
  }

}
