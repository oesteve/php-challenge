USE tv_series;    
    
INSERT INTO tv_series ( id, title, channel) VALUES 
('7da4da93-6163-4120-bf33-969885fb7c61', 'Breaking Bad', 'HBO'),
('bac8d51f-39fa-4741-ab72-2ff1c134dabe', 'Stranger Things', 'Netflix'),
('538d5910-c809-48db-a3a0-f9b191d9d68f', 'The Crow', 'BBC');
    
    
INSERT INTO tv_series_intervals ( id_tv_series, week_day, show_time) VALUES 
('7da4da93-6163-4120-bf33-969885fb7c61', 1, '19:00'),
('bac8d51f-39fa-4741-ab72-2ff1c134dabe', 6, '15:00'),
('538d5910-c809-48db-a3a0-f9b191d9d68f', 2, '17:00');
