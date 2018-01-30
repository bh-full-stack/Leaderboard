import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TopScoresComponent } from './top-scores.component';

describe('TopScoresComponent', () => {
  let component: TopScoresComponent;
  let fixture: ComponentFixture<TopScoresComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TopScoresComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TopScoresComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
