import { Component, OnInit } from '@angular/core';

import { SquadService } from '../../services/squad.service';
import { Squad } from '../../models/Squad';

@Component({
  selector: 'app-squad-list',
  templateUrl: './squad-list.component.html',
  styleUrls: ['./squad-list.component.css']
})
export class SquadListComponent implements OnInit {

  public squads: Squad[];

  constructor(private _squadService: SquadService) { }

  ngOnInit() {
    this._squadService.list().subscribe(
      squads => {
        this.squads = squads;
      },
      error => {
        console.log(error);
      }
    );
  }

  public join(squad) {
    this._squadService.join(squad).subscribe(
      success => {
        console.log(success);
      },
      error => {
        console.log(error);
      }
    );
  }

}
