import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

import { FileUploader } from 'ng2-file-upload';
import { environment } from '../../../../environments/environment';
import { Profile } from '../../models/profile';
import { PlayerService } from '../../services/player.service';
import { AuthService } from '../../../api/services/auth.service';
import { Player } from '../../models/player';

@Component({
  selector: 'app-profile-admin',
  templateUrl: './profile-admin.component.html',
  styleUrls: ['./profile-admin.component.css']
})
export class ProfileAdminComponent implements OnInit {

  public loading: boolean;
  public player: Player;
  public profile: Profile;
  public isUploading: boolean = false;
  public uploader: FileUploader = new FileUploader({
    url: environment.apiEndPoint + 'upload'
  });

  constructor(
    private _playerService: PlayerService,
    private _authService: AuthService,
    private _activatedRoute: ActivatedRoute,
    private _router: Router
  ) { }

  ngOnInit() {
    this.loading = true;
    this._activatedRoute.params.subscribe(
      params => this._playerService.showProfile(params.player_id).subscribe(
        player => {
          this.player = player;
          this.profile = Object.assign(new Profile, this.player.profile);
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
        this._router.navigate(['/player/profile/' + player.id]);
      },
      error => {
        console.log(error);
      }
    );
  }

}
