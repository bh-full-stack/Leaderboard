import { Component, OnInit } from '@angular/core';

import { TopScoresService } from '../../services/top-scores.service';
import { error } from 'util';

@Component({
  selector: 'app-top-scores',
  templateUrl: './top-scores.component.html',
  styleUrls: ['./top-scores.component.css']
})
export class TopScoresComponent implements OnInit {

  public topScores: any[];

  constructor(private _topScoresService: TopScoresService) { }

  ngOnInit() {
    this.loadTopScores();
  }

  public loadTopScores() {
    this._topScoresService.list().subscribe(
      response => this.topScores = response,
      error => console.log(error)
    );
  }

}
