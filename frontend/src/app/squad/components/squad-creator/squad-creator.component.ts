import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { Router } from '@angular/router';

import { AuthService } from '../../../api/services/auth.service';
import { SquadService } from '../../services/squad.service';
import { Squad } from '../../models/Squad';

@Component({
  selector: 'app-squad-creator',
  templateUrl: './squad-creator.component.html',
  styleUrls: ['./squad-creator.component.css']
})
export class SquadCreatorComponent implements OnInit {

  public squad: Squad = new Squad;
  public isCreated: boolean = false;
  public form = new FormGroup(
    {
      name: new FormControl('', [Validators.required]),
      color: new FormControl('', [Validators.required])
    }
  );

  public constructor(private _squadService: SquadService) {
    //
  }

  public ngOnInit() {
    //
  }

  public create() {
    this._squadService.create(this.squad).subscribe(
      response => {
        console.log(response);
        this.isCreated = true;

      },
      error => {
        console.log(error);
      }
    );
  }

}
