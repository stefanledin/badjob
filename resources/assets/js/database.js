import Dexie from 'dexie';

const db = new Dexie('badjob');
db.version(1).stores({
    project: '++id, name, timer_running, entries',
    entry: '++id, started_at, ended_at'
});

export default db;