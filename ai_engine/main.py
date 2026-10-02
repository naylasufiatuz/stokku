from fastapi import FastAPI
from pydantic import BaseModel

app = FastAPI()

class Item(BaseModel):
    id: int
    name: str
    stock: int
    history: list[float]  # penjualan per hari, urut dari terlama

class Req(BaseModel):
    items: list[Item]

@app.post("/predict")
def predict(r: Req):
    out = []
    for it in r.items:
        h = it.history
        lvl = h[0] if h else 0
        for v in h[1:]:
            lvl = 0.3 * v + 0.7 * lvl  # EWMA
        last, prev = sum(h[-7:]), sum(h[-14:-7])
        chg = round((last - prev) / prev * 100) if prev else 0
        trend = "naik" if chg > 10 else "turun" if chg < -10 else "stabil"
        out.append({
            "id": it.id, "name": it.name, "trend": trend, "change_pct": chg,
            "next_7_days": round(lvl * 7),
            "days_left": round(it.stock / lvl, 1) if lvl > 0 else None,
        })
    return {"items": out}
