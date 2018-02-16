import { Router, ActivatedRoute } from '@angular/router';
import { Component, OnInit } from '@angular/core';

import { SquadService } from './../../services/squad.service';
import { Squad } from './../../models/squad';
import { Player } from '../../../player/models/player';

@Component({
  selector: 'app-squad-page',
  templateUrl: './squad-page.component.html',
  styleUrls: ['./squad-page.component.css']
})
export class SquadPageComponent implements OnInit {

  public squad: Squad;
  public loading: boolean = true;
  public players: Player[];

  public constructor(
    private _squadService: SquadService,
    private _activatedRoute: ActivatedRoute,
    private _router: Router
  ) {
    //
  }

  public ngOnInit() {
    this._activatedRoute.params.subscribe(
      params => this._squadService.show(params.squadId).subscribe(
        squad => {
          this.squad = squad;
          this.players = this.squad.players;
          console.log(this.players);
          this.loading = false;
        },
        error => {
          console.log(error);
          this.loading = false;
          if (error.status == 404) {
            this._router.navigate(['/squad/list']);
          }
        }
      )
    )
  }

}
