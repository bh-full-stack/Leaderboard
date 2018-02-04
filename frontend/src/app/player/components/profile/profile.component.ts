import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { ChangeDetectorRef } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { DomSanitizer } from '@angular/platform-browser';

import { Player } from '../../models/player';
import { PlayerService } from '../../services/player.service';
import { AuthService } from '../../../shared/services/auth.service';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css']
})
export class ProfileComponent implements OnInit {

  public player: Player;
  public errors: {[field: string]: string[]} = {};
  public message: string;
  public loading: boolean;
  public isBeingEdited: boolean;
  public form = new FormGroup({
    password: new FormControl('', [Validators.required, Validators.minLength(6)])
  });
  public introduction: string;
 
  constructor(
    private _playerService: PlayerService,
    private _authService: AuthService,
    private _ref: ChangeDetectorRef,
    private _activatedRoute: ActivatedRoute,
    private _domSanitizer: DomSanitizer,
  ) { }

  ngOnInit() {
    this.loading = true;
    this._activatedRoute.params.subscribe(
      params => this._playerService.showProfile(params.player_id).subscribe(
        player => {
          this.player = player;
          this.introduction = this.player.profile.introduction;
          this.loading = false;
        },
        error => {
          console.log(error);
          this.loading = false;
        }
          
      )
    )
  }

  private trustHtml(html) {
    return this._domSanitizer.bypassSecurityTrustHtml(html);
  }

  public saveIntroduction() {
    this.isBeingEdited = !this.isBeingEdited;
    this.player.profile.introduction = this.introduction;
    this._playerService.updateIntroduction(this.player.id, this.player.profile.introduction).subscribe(
      player => {
        console.log(player);
      },
      error => {
        console.log(error);
      }
    );
  }

  public discardIntroductionChange() {
    this.isBeingEdited = !this.isBeingEdited;
    this.introduction = this.player.profile.introduction;
  }

  public toggleEdit() {
    this.isBeingEdited = !this.isBeingEdited;
  }

  public isAuthenticatedPlayer() {
    if (this._authService.player && this.player) {
      return this.player.id == this._authService.player.id;
    } else {
      return false;
    }
  }

  public handleOldScores(action: string) {
    this._playerService.handleOldScores(this.player.password, action).subscribe(
      response => { 
        this._authService.setPlayer(response['player']);
        this.message = response['message'];
        this.player = this._authService.player;
      },
      errorResponse => {
        this.errors = errorResponse.error.errors;
      }
    );
  }

}
