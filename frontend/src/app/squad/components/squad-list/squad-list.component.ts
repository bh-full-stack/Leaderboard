import { Router } from '@angular/router';
import { Component, OnInit } from '@angular/core';

import { SquadService } from '../../services/squad.service';
import { Squad } from '../../models/squad';
import { AuthService } from '../../../api/services/auth.service';

@Component({
  selector: 'app-squad-list',
  templateUrl: './squad-list.component.html',
  styleUrls: ['./squad-list.component.css']
})
export class SquadListComponent implements OnInit {

  public squads: Squad[];

  public constructor(
    private _squadService: SquadService,
    private _authService: AuthService,
    private _router: Router
  ) {
    //
  }

  public ngOnInit() {
    this.listSquads();
  }

  public listSquads() {
    if (this._authService.player) {
      this._squadService.listWithAuth().subscribe(
        squads => {
          this.squads = squads;
        },
        error => {
          console.log(error);
        }
      );
    } else {
      this._squadService.list().subscribe(
        squads => {
          this.squads = squads;
        },
        error => {
          console.log(error);
        }
      );
    }
  }

  public join(squad) {
    this._squadService.join(squad).subscribe(
      success => {
        this.listSquads();
      },
      error => {
        console.log(error);
      }
    );
  }

  public leave(squad) {
    this._squadService.leave(squad).subscribe(
      success => {
        this.listSquads();
      },
      error => {
        console.log(error);
      }
    );
  }

  public navigateTo(squadId) {
    this._router.navigate([`/squad/${squadId}`]);
  }

}
