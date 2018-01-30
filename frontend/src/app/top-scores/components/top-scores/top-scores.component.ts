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
  public sortDirection: string;
  public sortBy: string;
  public games: string[];
  public filterBy: string = 'all';

  constructor(private _topScoresService: TopScoresService) { }

  ngOnInit() {
    this.loadScores('top_score');
    this.loadGames();
  }

  public loadGames() {
    this._topScoresService.listGames().subscribe(
      response => this.games = response,
      error => console.log(error)
    );
  }

  public loadScores(sortBy: string) {
    const defaultDirections = {
      'name': 'ASC',
      'game': 'ASC',
      'top_score': 'DESC',
      'number_of_rounds': 'DESC'
    };

    this.sortDirection = this.sortDirection == 'DESC' ? 'ASC' : 'DESC';
    if (this.sortBy != sortBy) {
      this.sortDirection = defaultDirections[sortBy];
    }
    this.sortBy = sortBy;
    this._topScoresService.list(this.sortBy, this.sortDirection).subscribe(
      response => this.topScores = response,
      error => console.log(error)
    );
  }

}
