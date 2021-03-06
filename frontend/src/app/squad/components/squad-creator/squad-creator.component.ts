import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { Router } from '@angular/router';

import { AuthService } from '../../../api/services/auth.service';
import { SquadService } from '../../services/squad.service';
import { Squad } from '../../models/squad';

@Component({
  selector: 'app-squad-creator',
  templateUrl: './squad-creator.component.html',
  styleUrls: ['./squad-creator.component.css']
})
export class SquadCreatorComponent implements OnInit {

  public squad: Squad = new Squad;
  public isCreated: boolean = false;
  public errors: {[field: string]: string[]} = {};
  public form = new FormGroup(
    {
      name: new FormControl('', [Validators.required])
    }
  );

  public constructor(private _squadService: SquadService) {
    //
  }

  public ngOnInit() {
    this.squad.color = '#fff';
  }

  public create() {
    this._squadService.create(this.squad).subscribe(
      response => {
        this.isCreated = true;
      },
      errorResponse => {
        this.errors = errorResponse.error.errors;
      }
    );
  }

}
