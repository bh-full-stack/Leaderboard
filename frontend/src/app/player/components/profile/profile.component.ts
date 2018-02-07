import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { ChangeDetectorRef } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { DomSanitizer } from '@angular/platform-browser';
import { FileUploader } from 'ng2-file-upload';

import { Player } from '../../models/player';
import { PlayerService } from '../../services/player.service';
import { AuthService } from '../../../api/services/auth.service';
import { Profile } from '../../models/profile';
import { environment } from '../../../../environments/environment';

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
  public isUploading: boolean = false;
  public isBeingEdited: boolean;
  public form = new FormGroup({
    password: new FormControl('', [Validators.required, Validators.minLength(6)])
  });
  public profile: Profile;
  public uploader: FileUploader = new FileUploader({
    url: environment.apiEndPoint + 'upload'
  });
 
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
          if (this.player.profile) {
            this.profile = Object.assign(new Profile, this.player.profile);
          }
          this.loading = false;
        },
        error => {
          console.log(error);
          this.loading = false;
        }
          
      )
    )
  }

  ngAfterViewInit() {
    this.uploader.onAfterAddingFile = item => {
      this.isUploading = true;
      item.withCredentials = false;
      this.uploader.uploadAll();
    };
    this.uploader.onSuccessItem = (item, response, status, headers) => {
      this.profile.picture = JSON.parse(response);
      this.profile.picture_id = this.profile.picture.id;
      this.isUploading = false;
    };    
  }

  public saveProfile() {
    this._playerService.updateProfile(this.player.id, this.profile).subscribe(
      player => {
        this.player = player;
        this._authService.player = player;
        this.isBeingEdited = false;
      },
      error => {
        console.log(error);
      }
    );
  }

  public discardIntroductionChange() {
    this.isBeingEdited = false;
    this.profile = Object.assign(new Profile, this.player.profile);
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
